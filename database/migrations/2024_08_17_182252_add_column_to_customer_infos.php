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
            $table->string('linkfb');
            $table->string('desiredAmount');
            $table->string('desiredDuration');
            $table->string('income');
            $table->string('amount')->nullable();;
            $table->string('duration')->nullable();
            $table->timestamp('call_time')->nullable();
            $table->timestamp('transfer_time')->nullable();
            $table->unsignedBigInteger('contract_id')->nullable();
            $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_infos', function (Blueprint $table) {
            $table->dropColumn('linkfb');
            $table->dropColumn('desiredAmount');
            $table->dropColumn('desiredDuration');
            $table->dropColumn('income');
            $table->dropColumn('amount');
            $table->dropColumn('duration');
            $table->dropColumn('call_time');
            $table->dropColumn('transfer_time');
            $table->dropForeign(['contract_id']);
            $table->dropColumn('contract_id');
        });
    }
};
