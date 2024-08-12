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
        Schema::create('customer_infor_v2s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_info_id')->constrained()->onDelete('cascade');
            $table->string('frontCCCD');
            $table->string('backCCCD');
            $table->string('salary_slip');
            $table->string('faceData');
            $table->boolean('confirm');
            $table->boolean('accept');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_infor_v2s');
    }
};
