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
            $table->date('crj_entrynum_date')->nullable();
            $table->integer('crj_jevnum')->nullable();
            $table->string('crj_payor')->nullable();
            $table->decimal('crj_collection_debit',15,2)->nullable();
            $table->decimal('crj_collection_credit',15,2)->nullable();
            $table->decimal('crj_deposit_debit',15,2)->nullable();
            $table->decimal('crj_deposit_credit',15,2)->nullable();
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
