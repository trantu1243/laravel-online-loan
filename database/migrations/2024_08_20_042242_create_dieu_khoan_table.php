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
        Schema::create('dieu_khoan', function (Blueprint $table) {
            $table->id();
            $table->longText('dk_xu_ly_du_lieu_ca_nhan');
            $table->longText('dk_giao_dich');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dieu_khoan');
    }
};
