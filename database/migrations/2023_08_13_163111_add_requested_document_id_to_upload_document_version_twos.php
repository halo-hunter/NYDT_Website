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
        Schema::table('upload_document_version_twos', function (Blueprint $table) {
            // original table does not have is_uploaded; place after description instead
            $table->integer('requested_document_id')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('upload_document_version_twos', function (Blueprint $table) {
            $table->dropColumn('requested_document_id');
        });
    }
};
