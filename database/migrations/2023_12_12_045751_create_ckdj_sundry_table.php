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
        Schema::create('ckdj_sundry', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('check_disbursement_journal_id')->nullable();
            $table->string('ckdj_sundry_account_code')->nullable();
            $table->decimal('ckdj_sundry_debit')->nullable();
            $table->decimal('ckdj_sundry_credit')->nullable();
            $table->timestamps();
        
            $table->foreign('check_disbursement_journal_id')
                ->references('id')
                ->on('check_disbursement_journal')
                ->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ckdj_sundry');
    }
};