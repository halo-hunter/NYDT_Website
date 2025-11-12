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
        Schema::create('company_infos', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_address_country')->nullable();
            $table->string('company_address_state_code')->nullable();
            $table->string('company_address_city')->nullable();
            $table->string('company_address_zip_code')->nullable();
            $table->string('company_address_unit')->nullable();
            $table->text('company_address_address_1')->nullable();
            $table->text('company_address_address_2')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_infos');
    }
};
