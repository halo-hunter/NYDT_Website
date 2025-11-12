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

class Interview implements ShouldQueue
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
        Log::info('JOB: S Interview');

        $interviews = CaseModel::where('interview_datetime', '!=', null)->get();

        if (count($interviews) > 0) {

            foreach ($interviews as $interview) {

                $case = $interview;

                $case_id = $case->id;

                $client = $case->client()->first();

                $client_id = $client->id;

                $client_email = $client->email;

                $interview_datetime = $case->interview_datetime;
                $interview_datetime_address = $case->interview_address;

                $is_reminded_by_email = CaseModel::where('id', $case_id)->where('interview_is_reminded_by_email', true)->exists();
                $is_reminded_by_sms = CaseModel::where('id', $case_id)->where('interview_is_reminded_by_sms', true)->exists();


                $interview_datetime_to_carbon = new Carbon($case->interview_datetime);
                $day_difference = $interview_datetime_to_carbon->diffInDays(Carbon::now());

                if ($day_difference == ReminderSetting::where('key', 'interview_date')->first()->days) {

                    if ($client_email != null && !$is_reminded_by_email) {

                        $mail_data = [
                            'case_id' => $case->id,
                            'interview_datetime' => $interview_datetime,
                            'interview_address' => $interview_datetime_address
                        ];

                        Mail::to($client_email)
                            ->bcc(EmailSettings::get_bcc_mail_addresses_with_dev_email())
                            ->send(new \App\Mail\Crm\Interview($mail_data));

                        $riders_emails = GenericController::get_client_riders_email_addresses($client_id);

                        if (count($riders_emails) > 0) {

                            foreach ($riders_emails as $rider_email) {

                                Mail::to($rider_email)
                                    ->bcc(EmailSettings::get_bcc_mail_addresses_with_dev_email())
                                    ->send(new \App\Mail\Crm\Interview($mail_data));

                            }

                        }

                        CaseModel::where('id', $case_id)->update([
                            'interview_is_reminded_by_email' => true
                        ]);

                    }

                    $client_phone = $client->phone;

                    if ($client_phone != null && !$is_reminded_by_sms) {

                        GenericController::twilio_send_sms($client_id, $case_id, null, $client_phone, "Interview datetime: $interview_datetime \n Interview address: $interview_datetime_address");

                        $riders_phones = GenericController::get_client_riders_phone_numbers($client_id);

                        if (count($riders_phones) > 0) {

                            foreach ($riders_phones as $rider_phone) {

                                GenericController::twilio_send_sms($client_id, $case_id, null, $rider_phone, "Interview datetime: $interview_datetime \n Interview address: $interview_datetime_address");

                            }

                        }

                        CaseModel::where('id', $case_id)->update([
                            'interview_is_reminded_by_sms' => true
                        ]);

                    }

                }

            }

        }

        Log::info('JOB: E Interview');
    }
}
