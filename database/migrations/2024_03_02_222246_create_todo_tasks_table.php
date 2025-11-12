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
        Schema::create('todo_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('case');
            $table->unsignedBigInteger('author')->comment('user_id');
            $table->unsignedBigInteger('assigned_to')->comment('user_id');
            $table->text('description');
            $table->boolean('status')->default(false);
            $table->datetime('complete_time')->nullable();
            $table->string('spent_hours')->nullable();
            $table->boolean('seen')->default(false);
            $table->timestamps();

            $table->foreign('case')->references('id')->on('cases')->onDelete('cascade');
            $table->foreign('author')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todo_tasks');
    }
};
