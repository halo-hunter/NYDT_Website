<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Null out and rename the leaked column to make future inserts consistent.
        if (Schema::hasTable('invalid_login_attempts') && Schema::hasColumn('invalid_login_attempts', 'filled_guest_password')) {
            DB::table('invalid_login_attempts')->update(['filled_guest_password' => '[redacted]']);
            Schema::table('invalid_login_attempts', function (Blueprint $table) {
                $table->renameColumn('filled_guest_password', 'filled_guest_password_redacted');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('invalid_login_attempts') && Schema::hasColumn('invalid_login_attempts', 'filled_guest_password_redacted')) {
            Schema::table('invalid_login_attempts', function (Blueprint $table) {
                $table->renameColumn('filled_guest_password_redacted', 'filled_guest_password');
            });
        }
    }
};
