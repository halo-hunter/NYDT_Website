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
        Schema::create('employment_within_last_five_years', function (Blueprint $table) {
            $table->id();
            $table->string('employment_w_l_f_y__name')->nullable();
            $table->string('employment_w_l_f_y__address_of_employer')->nullable();
            $table->string('employment_w_l_f_y__your_occupation')->nullable();
            $table->date('employment_w_l_f_y__from')->nullable();
            $table->date('employment_w_l_f_y__to')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment_within_last_five_years');
    }
};
