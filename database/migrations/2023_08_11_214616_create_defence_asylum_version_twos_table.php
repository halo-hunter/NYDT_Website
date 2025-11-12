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
        Schema::create('defence_asylum_version_twos', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('case_id');
            $table->string('name');
            $table->date('filing_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('defence_asylum_version_twos');
    }
};
