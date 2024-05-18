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
            $table->integer('gl_symbol')->nullable;
            $table->string('gl_fundname')->nullable;
            $table->string('gl_func_classification')->nullable;
            $table->string('gl_project_title')->nullable;
            $table->date('gl_date')->nullable;
            $table->string('gl_vouchernum')->nullable; //@vince eto inedit ko
            $table->longText('gl_particulars')->nullable; //@vince eto inedit ko
            $table->decimal('gl_balance_debit')->nullable;
            $table->decimal('gl_debit', 15,2)->nullable;
            $table->decimal('gl_credit', 15,2)->nullable;
            $table->decimal('gl_credit_balance')->nullable;
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
