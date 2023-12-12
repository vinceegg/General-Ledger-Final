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
        Schema::create('gj_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('general_journal_id')->nullable();
            $table->string('gj_account_code')->nullable();  
            $table->decimal('gj_account_code_debit')->nullable();
            $table->decimal('gj_account_code_credit')->nullable();
            $table->timestamps();

            $table->foreign('general_journal_id')
                ->references('id')
                ->on('general_journal')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gj_accounts');
    }
};