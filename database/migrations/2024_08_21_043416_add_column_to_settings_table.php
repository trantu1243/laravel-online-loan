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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('footer_bg');
            $table->string('mb_footer_bg');
            $table->string('color');
            $table->string('bg_color');
            $table->string('line_color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('footer_bg');
            $table->dropColumn('mb_footer_bg');
            $table->dropColumn('color');
            $table->dropColumn('bg_color');
            $table->dropColumn('line_color');
        });
    }
};
