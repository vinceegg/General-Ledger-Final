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
        Schema::create('ledgersheet', function (Blueprint $table) {
            $table->bigIncrements('ledgersheet_no');
            $table->string('ls_vouchernum')->nullable();
            $table->string('ls_accountname');
            $table->date('ls_date')->nullable();
            $table->longText('ls_particulars')->nullable(); //@vince eto inedit ko
            $table->decimal('ls_balance_debit',15,2)->nullable();
            $table->decimal('ls_debit', 15,2)->nullable();
            $table->decimal('ls_credit', 15,2)->nullable();
            $table->decimal('ls_credit_balance',15,2)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ledgersheet');
    }
};
