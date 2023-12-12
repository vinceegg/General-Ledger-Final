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
        Schema::create('cdj_sundry', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cash_disbursement_journal_id')->nullable();
            $table->string('cdj_sundry_account_code')->nullable();
            $table->string('cdj_sundry_pr')->nullable();
            $table->decimal('cdj_sundry_debit')->nullable();
            $table->decimal('cdj_sundry_credit')->nullable();
            $table->timestamps();

            $table->foreign('cash_disbursement_journal_id')
                ->references('id')
                ->on('cash_disbursement_journal')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cdj_sundry');
    }
};