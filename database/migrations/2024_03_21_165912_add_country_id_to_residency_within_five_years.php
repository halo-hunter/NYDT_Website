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
        Schema::table('residency_within_five_years', function (Blueprint $table) {
            $table->integer('country_id')->nullable()->after('department_province_or_state');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('residency_within_five_years', function (Blueprint $table) {
            $table->dropColumn('country_id');
        });
    }
};
