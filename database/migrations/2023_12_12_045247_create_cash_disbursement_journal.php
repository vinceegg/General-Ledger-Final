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
        Schema::create('cash_disbursement_journal', function (Blueprint $table) {
            $table->bigIncrements('cashdisbursementjournal_no');
            $table->string('cdj_jevnum')->nullable();
            $table->date('cdj_entrynum_date')->nullable();
            $table->string('cdj_referencenum')->nullable();
            $table->integer('cdj_bur')->nullable();
            $table->string('cdj_accountable_officer')->nullable();
            $table->string('cdj_credit_accountcode')->nullable();
            $table->decimal('cdj_amount',15,2)->nullable();
            $table->decimal('cdj_account1',15,2)->nullable();
            $table->decimal('cdj_account2',15,2)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_disbursement_journal');
    }
};
