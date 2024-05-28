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
            $table->bigIncrements('crj_id');
            $table->string('crj_jevnum'); // Define the foreign key column
            $table->foreign('crj_jevnum')->references('crj_jevnum')->on('cash_receipt_journal')->onDelete('cascade'); // Set the foreign key constraint
            $table->string('crj_accountcode')->nullable();
            $table->decimal('crj_debit', 15,2)->nullable();
            $table->decimal('crj_credit', 15,2)->nullable();
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
