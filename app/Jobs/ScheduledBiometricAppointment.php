<?php

namespace App\Jobs;

use App\Http\Controllers\Crm\GenericController;
use App\Models\Crm\CaseModel;
use App\Models\Crm\EmailSettings;
use App\Models\Crm\ReminderSetting;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ScheduledBiometricAppointment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        Log::info('JOB: S ScheduledBiometricAppointment');

        $scheduled_biometric_appointments = CaseModel::where('scheduled_biometric_appointment_datetime', '!=', null)->get();

        if (count($scheduled_biometric_appointments) > 0) {

            foreach ($scheduled_biometric_appointments as $scheduled_biometric_appointment) {

                $case = $scheduled_biometric_appointment;

                $case_id = $case->id;

                $client = $case->client()->first();

                $client_id = $client->id;

                $client_email = $client->email;

                $scheduled_biometric_appointment_datetime = $case->scheduled_biometric_appointment_datetime;
                $scheduled_biometric_appointment_address = $case->scheduled_biometric_appointment_address;

                $is_reminded_by_email = CaseModel::where('id', $case_id)->where('scheduled_biometric_appointment_is_reminded_by_email', true)->exists();
                $is_reminded_by_sms = CaseModel::where('id', $case_id)->where('scheduled_biometric_appointment_is_reminded_by_sms', true)->exists();


                $scheduled_biometric_appointment_datetime_to_carbon = new Carbon($case->scheduled_biometric_appointment_datetime);
                $day_difference = $scheduled_biometric_appointment_datetime_to_carbon->diffInDays(Carbon::now());

                if ($day_difference == ReminderSetting::where('key', 'scheduled_biometric_appointment')->first()->days) {

                    if ($client_email != null && !$is_reminded_by_email) {

                        $mail_data = [
                            'case_id' => $case->id,
                            'scheduled_biometric_appointment_datetime' => $scheduled_biometric_appointment_datetime,
                            'scheduled_biometric_appointment_address' => $scheduled_biometric_appointment_address
                        ];

                        Mail::to($client_email)
                            ->bcc(EmailSettings::get_bcc_mail_addresses_with_dev_email())
                            ->send(new \App\Mail\Crm\ScheduledBiometricAppointment($mail_data));

                        $riders_emails = GenericController::get_client_riders_email_addresses($client_id);

                        if (count($riders_emails) > 0) {

                            foreach ($riders_emails as $rider_email) {

                                Mail::to($rider_email)
                                    ->bcc(EmailSettings::get_bcc_mail_addresses_with_dev_email())
                                    ->send(new \App\Mail\Crm\ScheduledBiometricAppointment($mail_data));

                            }

                        }

                        CaseModel::where('id', $case_id)->update([
                            'scheduled_biometric_appointment_is_reminded_by_email' => true
                        ]);

                    }

                    $client_phone = $client->phone;

                    if ($client_phone != null && !$is_reminded_by_sms) {

                        GenericController::twilio_send_sms($client_id, $case_id, null, $client_phone, "Scheduled biometric appointment datetime: $scheduled_biometric_appointment_datetime \n Scheduled biometric appointment address: $scheduled_biometric_appointment_address");

                        $riders_phones = GenericController::get_client_riders_phone_numbers($client_id);

                        if (count($riders_phones) > 0) {

                            foreach ($riders_phones as $rider_phone) {

                                GenericController::twilio_send_sms($client_id, $case_id, null, $rider_phone, "Scheduled biometric appointment datetime: $scheduled_biometric_appointment_datetime \n Scheduled biometric appointment address: $scheduled_biometric_appointment_address");

                            }

                        }

                        CaseModel::where('id', $case_id)->update([
                            'scheduled_biometric_appointment_is_reminded_by_sms' => true
                        ]);

                    }

                }

            }

        }

        Log::info('JOB: E ScheduledBiometricAppointment');

    }
}
