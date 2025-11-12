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
            $table->datetime('interview_datetime')->nullable()->after('scheduled_biometric_appointment_address');
            $table->text('interview_address')->nullable()->after('interview_datetime');
            $table->boolean('interview_is_reminded_by_email')->default(false)->after('interview_address');
            $table->boolean('interview_is_reminded_by_sms')->default(false)->after('interview_is_reminded_by_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cases', function (Blueprint $table) {
            $table->dropColumn('interview_datetime');
            $table->dropColumn('interview_address');
            $table->dropColumn('interview_is_reminded_by_email');
            $table->dropColumn('interview_is_reminded_by_sms');
        });
    }
};
