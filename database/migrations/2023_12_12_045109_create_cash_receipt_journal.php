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
        Schema::create('cash_receipt_journal', function (Blueprint $table) {
            $table->id();
            $table->integer('crj_entrynum')->nullable();
            $table->date('crj_entrynum_date')->nullable();
            $table->integer('crj_jevnum')->nullable();
            $table->string('crj_payor')->nullable();
            $table->decimal('crj_collection_debit')->nullable();
            $table->decimal('crj_collection_credit')->nullable();
            $table->decimal('crj_deposit_debit')->nullable();
            $table->decimal('crj_deposit_credit')->nullable();
            $table->string('crj_accountcode')->nullable();
            $table->decimal('crj_debit')->nullable();
            $table->decimal('crj_credit')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_receipt_journal');
    }
};
