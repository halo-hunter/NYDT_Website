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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('a_number')->nullable();
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('social_security')->nullable();
            $table->string('address_country')->nullable();
            $table->string('address_state_code')->nullable();
            $table->string('address_city')->nullable();
            $table->string('address_zip_code')->nullable();
            $table->string('address_unit')->nullable();
            $table->string('address_address')->nullable();
            $table->string('profile_photo')->nullable();
            $table->string('password')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
