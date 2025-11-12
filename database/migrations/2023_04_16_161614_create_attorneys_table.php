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
        Schema::create('attorneys', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('company_name');
            $table->string('company_address_country');
            $table->string('company_address_state_code');
            $table->string('company_address_city');
            $table->string('company_address_zip_code');
            $table->string('company_address_unit');
            $table->text('company_address_address');
            $table->string('email');
            $table->string('phone');
            $table->string('fax')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attorneys');
    }
};
