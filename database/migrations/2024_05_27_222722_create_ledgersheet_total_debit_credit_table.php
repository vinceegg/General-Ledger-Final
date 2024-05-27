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
        Schema::create('ledgersheet_total_debit_credit', function (Blueprint $table) {
            $table->id('ls_totals_id');
            $table->string('ls_accountname');
            $table->enum('ls_summary_type', ['monthly', 'yearly']);
            $table->string('ls_summary_month')->nullable(); // Nullable for yearly summaries
            $table->string('ls_summary_year');
            $table->decimal('ls_total_credit', 15, 2);
            $table->decimal('ls_total_debit', 15, 2);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ledgersheet_total_debit_credit');
    }
};
