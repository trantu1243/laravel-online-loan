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
            $table->string('mb_logo_footer');
            $table->string('dieu_khoan_xu_ly_du_lieu_ca_nhan');
            $table->string('dieu_khoan_giao_dich');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('mb_logo_footer');
            $table->dropColumn('dieu_khoan_xu_ly_du_lieu_ca_nhan');
            $table->dropColumn('dieu_khoan_giao_dich');
        });
    }
};
