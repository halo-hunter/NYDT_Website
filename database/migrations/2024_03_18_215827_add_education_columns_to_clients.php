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
            $table->string('education__name_of_school')->nullable()->after('password');
            $table->string('education__type_of_school')->nullable()->after('education__name_of_school');
            $table->string('education__location')->nullable()->after('education__type_of_school');
            $table->string('education__major')->nullable()->after('education__location');
            $table->date('education__from')->nullable()->after('education__major');
            $table->date('education__to')->nullable()->after('education__from');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('education__name_of_school');
            $table->dropColumn('education__type_of_school');
            $table->dropColumn('education__location');
            $table->dropColumn('education__major');
            $table->dropColumn('education__from');
            $table->dropColumn('education__to');
        });
    }
};
