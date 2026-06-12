<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mosque_profiles', function (Blueprint $table) {
            $table->string('hero_image')->nullable()->after('logo');
            $table->string('favicon')->nullable()->after('hero_image');
            $table->text('footer_text')->nullable()->after('favicon');
        });
    }

    public function down(): void
    {
        Schema::table('mosque_profiles', function (Blueprint $table) {
            $table->dropColumn(['hero_image', 'favicon', 'footer_text']);
        });
    }
};
