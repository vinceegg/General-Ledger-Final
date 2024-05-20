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
        Schema::create('general_ledger', function (Blueprint $table) {
            $table->id();
            $table->date('gl_date')->nullable;
            $table->integer('gl_vouchernum')->nullable;
            $table->string('gl_particulars')->nullable;
            $table->decimal('gl_balance_debit',15,2)->nullable;
            $table->decimal('gl_debit', 15,2)->nullable;
            $table->decimal('gl_credit', 15,2)->nullable;
            $table->decimal('gl_credit_balance',15,2)->nullable;
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_ledger');
    }
};
