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
        Schema::create('ckdj_sundry_data', function (Blueprint $table) {
            $table->bigIncrements('ckdj_id');
            $table->string('ckdj_checknum');
            $table->foreign('ckdj_checknum')->references('ckdj_checknum')->on('check_disbursement_journal')->onDelete('cascade');
            $table->string('ckdj_accountcode')->nullable();
            $table->decimal('ckdj_debit', 15,2)->nullable();
            $table->decimal('ckdj_credit', 15,2)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ckdj_sundry_data');
    }
};
