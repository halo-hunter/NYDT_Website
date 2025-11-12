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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('contract_number')->nullable()->after('lastname');
            $table->string('a_number')->nullable()->after('contract_number');
            $table->timestamp('ead_clock')->nullable()->after('a_number');
            $table->string('address_country')->nullable()->after('ead_clock');
            $table->string('address_state_code')->nullable()->after('address_country');
            $table->string('address_city')->nullable()->after('address_state_code');
            $table->string('address_zip_code')->nullable()->after('address_city');
            $table->string('address_unit')->nullable()->after('address_zip_code');
            $table->text('address_address')->nullable()->after('address_unit');
            $table->timestamp('hearing_date')->nullable()->after('address_unit');
            $table->timestamp('docket_date')->nullable()->after('hearing_date');
            $table->timestamp('filling_date')->nullable()->after('docket_date');
            $table->timestamp('entry_in_the_usa_date')->nullable()->after('filling_date');
            $table->string('judge')->nullable()->after('entry_in_the_usa_date');
            $table->integer('type_of_hearing_id')->nullable()->after('attorney_id');
            $table->float('retainer_cost')->nullable()->after('type_of_hearing_id');
            $table->float('total_balance')->nullable()->after('retainer_cost');
            $table->float('attorney_cost')->nullable()->after('total_balance');
            $table->float('dt_paralegal_services')->nullable()->after('attorney_cost');
            $table->float('total_paid')->nullable()->after('dt_paralegal_services');
            $table->timestamp('due_date')->nullable()->after('total_paid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('contract_number');
            $table->dropColumn('a_number');
            $table->dropColumn('ead_clock');
            $table->dropColumn('address_country');
            $table->dropColumn('address_state_code');
            $table->dropColumn('address_city');
            $table->dropColumn('address_zip_code');
            $table->dropColumn('address_unit');
            $table->dropColumn('address_address');
            $table->dropColumn('hearing_date');
            $table->dropColumn('docket_date');
            $table->dropColumn('filling_date');
            $table->dropColumn('entry_in_the_usa_date');
            $table->dropColumn('judge');
            $table->dropColumn('type_of_hearing_id');
            $table->dropColumn('retainer_cost');
            $table->dropColumn('total_balance');
            $table->dropColumn('attorney_cost');
            $table->dropColumn('dt_paralegal_services');
            $table->dropColumn('total_paid');
            $table->dropColumn('due_date');
        });
    }
};
