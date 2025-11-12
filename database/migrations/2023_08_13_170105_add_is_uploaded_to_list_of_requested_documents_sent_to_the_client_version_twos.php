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
        Schema::table('list_of_requested_documents_sent_to_the_client_version_twos', function (Blueprint $table) {
            $table->boolean('is_uploaded')->default(false)->after('document_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('list_of_requested_documents_sent_to_the_client_version_twos', function (Blueprint $table) {
            $table->dropColumn('is_uploaded');
        });
    }
};
