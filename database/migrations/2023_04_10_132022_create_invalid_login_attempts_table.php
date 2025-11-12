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
        Schema::create('invalid_login_attempts', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->text('user_agent');
            $table->text('filled_guest_email');
            $table->text('filled_guest_password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invalid_login_attempts');
    }
};
