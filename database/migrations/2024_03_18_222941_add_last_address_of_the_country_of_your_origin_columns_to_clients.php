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
        Schema::table('clients', function (Blueprint $table) {
            $table->string('last_address_o_t_c_o_y_o__number_and_street')->nullable()->after('education__to');
            $table->string('last_address_o_t_c_o_y_o__city_town')->nullable()->after('last_address_o_t_c_o_y_o__number_and_street');
            $table->string('last_address_o_t_c_o_y_o__department_province_or_state')->nullable()->after('last_address_o_t_c_o_y_o__city_town');
            $table->integer('last_address_o_t_c_o_y_o__country_id')->nullable()->after('last_address_o_t_c_o_y_o__department_province_or_state');
            $table->date('last_address_o_t_c_o_y_o__from')->nullable()->after('last_address_o_t_c_o_y_o__country_id');
            $table->date('last_address_o_t_c_o_y_o__to')->nullable()->after('last_address_o_t_c_o_y_o__from');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('last_address_o_t_c_o_y_o__number_and_street');
            $table->dropColumn('last_address_o_t_c_o_y_o__city_town');
            $table->dropColumn('last_address_o_t_c_o_y_o__department_province_or_state');
            $table->dropColumn('last_address_o_t_c_o_y_o__country_id');
            $table->dropColumn('last_address_o_t_c_o_y_o__from');
            $table->dropColumn('last_address_o_t_c_o_y_o__to');
        });
    }
};
