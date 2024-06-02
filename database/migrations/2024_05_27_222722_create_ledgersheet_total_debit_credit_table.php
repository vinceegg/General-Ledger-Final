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
            $table->uuid('ls_totals_id')->primary();
            $table->string('ls_account_title_code', 255);
            $table->string('ls_summary_type');
            $table->string('ls_summary_month')->nullable(); // Nullable for yearly summaries
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