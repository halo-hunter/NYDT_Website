<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    // TODO: S https://github.com/Zrabo/NYDT/issues/9

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cases', function (Blueprint $table) {
            // First, drop the due_date column
            $table->dropColumn('due_date');
        });

        Schema::table('cases', function (Blueprint $table) {
            // Then, add due_date again after case_subtype with JSON type
            $table->json('due_date')->nullable()->after('case_subtype');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cases', function (Blueprint $table) {
            // Remove the JSON due_date column
            $table->dropColumn('due_date');
        });

        Schema::table('cases', function (Blueprint $table) {
            // Add back due_date as TIMESTAMP at the original position
            $table->timestamp('due_date')->nullable()->after('case_subtype');
        });
    }

    // TODO: E https://github.com/Zrabo/NYDT/issues/9

};
