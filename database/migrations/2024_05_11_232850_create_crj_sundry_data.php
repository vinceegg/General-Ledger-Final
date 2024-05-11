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
        Schema::create('crj_sundry_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cash_receipt_journal_id')->constrained('cash_receipt_journal')->onDelete('cascade');
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
        Schema::dropIfExists('crj_sundry_data');
    }
};
