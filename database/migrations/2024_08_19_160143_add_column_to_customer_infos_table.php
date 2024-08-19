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
        Schema::table('customer_infos', function (Blueprint $table) {
            $table->boolean('paid')->nullable();
            $table->integer('num_reminder')->nullable();
            $table->integer('month_num')->nullable();
            $table->integer('day')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_infos', function (Blueprint $table) {
            $table->dropColumn('paid');
            $table->dropColumn('num_reminder');
            $table->dropColumn('month_num');
            $table->dropColumn('day');
        });
    }
};
