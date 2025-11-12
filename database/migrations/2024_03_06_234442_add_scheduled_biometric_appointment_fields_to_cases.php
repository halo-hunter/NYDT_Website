<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cases', function (Blueprint $table) {
            $table->datetime('scheduled_biometric_appointment_datetime')->nullable()->after('docket_date');
            $table->text('scheduled_biometric_appointment_address')->nullable()->after('scheduled_biometric_appointment_datetime');
            $table->boolean('scheduled_biometric_appointment_is_reminded_by_email')->default(false)->after('scheduled_biometric_appointment_address');
            $table->boolean('scheduled_biometric_appointment_is_reminded_by_sms')->default(false)->after('scheduled_biometric_appointment_is_reminded_by_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cases', function (Blueprint $table) {
            $table->dropColumn('scheduled_biometric_appointment_datetime');
            $table->dropColumn('scheduled_biometric_appointment_address');
            $table->dropColumn('scheduled_biometric_appointment_is_reminded_by_email');
            $table->dropColumn('scheduled_biometric_appointment_is_reminded_by_sms');
        });
    }
};
