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
        Schema::create('cases', function (Blueprint $table) {
            $table->id();

            $table->string('contract_number')->nullable();
            $table->timestamp('hearing_date')->nullable();
            $table->timestamp('docket_date')->nullable();
            $table->timestamp('filling_date')->nullable();
            $table->timestamp('entry_in_the_usa_date')->nullable();
            $table->string('judge')->nullable();
            $table->integer('attorney_id')->nullable()->default(0);
            $table->integer('type_of_hearing_id')->nullable();
            $table->float('retainer_cost')->nullable();
            $table->date('retainer_date')->nullable();
            $table->string('upload_retainer')->nullable();
            $table->float('total_balance')->nullable();
            $table->float('attorney_cost')->nullable();
            $table->float('dt_paralegal_services')->nullable();
            $table->float('total_paid')->nullable();
            $table->string('class_of_admissions')->nullable();
            $table->string('case_type')->nullable();
            $table->timestamp('due_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cases');
    }
};
