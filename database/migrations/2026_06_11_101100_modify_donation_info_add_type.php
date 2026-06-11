<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donation_info', function (Blueprint $table) {
            $table->string('type')->default('bank')->after('id');
            $table->string('bank_name')->nullable()->change();
            $table->string('account_number')->nullable()->change();
            $table->string('account_name')->nullable()->change();
        });

        DB::table('donation_info')->whereNull('type')->update(['type' => 'bank']);
    }

    public function down(): void
    {
        Schema::table('donation_info', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->string('bank_name')->nullable(false)->change();
            $table->string('account_number')->nullable(false)->change();
            $table->string('account_name')->nullable(false)->change();
        });
    }
};
