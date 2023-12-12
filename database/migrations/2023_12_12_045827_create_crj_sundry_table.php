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
        Schema::create('crj_sundry', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cash_receipt_journal_id')->nullable();
            $table->string('crj_sundry_account_code')->nullable();
            $table->decimal('crj_sundry_debit')->nullable();
            $table->decimal('crj_sundry_credit')->nullable();
            $table->timestamps();

            $table->foreign('cash_receipt_journal_id')
                ->references('id')
                ->on('cash_receipt_journal')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crj_sundry');
    }
};