<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            if (!Schema::hasColumn('clients', 'password_status')) {
                $table->string('password_status')->default('pending')->after('password');
            }
        });

        DB::table('clients')
            ->whereNotNull('password')
            ->where('password', '!=', '1')
            ->update(['password_status' => 'set']);

        DB::table('clients')
            ->whereNull('password')
            ->orWhere('password', '=', '1')
            ->update(['password_status' => 'pending']);
    }

    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            if (Schema::hasColumn('clients', 'password_status')) {
                $table->dropColumn('password_status');
            }
        });
    }
};
