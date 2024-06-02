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
        Schema::create('cdj_sundry_data', function (Blueprint $table) {
            $table->bigIncrements('cdj_id');
            $table->unsignedBigInteger('cashdisbursementjournal_no'); // Define the foreign key column
            $table->foreign('cashdisbursementjournal_no')->references('cashdisbursementjournal_no')->on('cash_disbursement_journal')->onDelete('cascade');
            $table->string('cdj_sundry_accountcode')->nullable();
            $table->string('cdj_pr')->nullable();
            $table->decimal('cdj_debit', 15,2)->nullable();
            $table->decimal('cdj_credit', 15,2)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cdj_sundry_data');
    }
};