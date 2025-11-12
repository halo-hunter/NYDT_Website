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
        Schema::table('logins', function (Blueprint $table) {
            $table->string('ip')->after('id');
            $table->text('user_agent')->after('ip');
            $table->json('user_data')->after('user_agent');
            $table->string('auth_type')->comment('1: Login, 0: Logout')->after('user_data');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('logins', function (Blueprint $table) {
            //
        });
    }
};
