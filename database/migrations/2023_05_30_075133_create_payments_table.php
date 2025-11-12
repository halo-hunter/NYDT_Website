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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('payment_type');
            $table->integer('invoice_number');
            $table->float('amount');
            $table->string('payment_description')->nullable();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('customer_type');
            $table->string('customer_id');
            $table->string('payment_status');
            $table->string('payment_transaction_id');
            $table->string('ip');
            $table->string('user_agent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
