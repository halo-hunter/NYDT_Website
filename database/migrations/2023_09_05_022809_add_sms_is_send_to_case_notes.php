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
        Schema::table('case_notes', function (Blueprint $table) {
            $table->boolean('sms_is_send')->default(false)->after('email_is_send');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('case_notes', function (Blueprint $table) {
            $table->dropColumn('sms_is_send');
        });
    }
};
