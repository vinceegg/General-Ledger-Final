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
        Schema::create('gj_accountcodes_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('general_journal_id')->constrained('general_journal')->onDelete('cascade');
            $table->string('gj_accountcode')->nullable();
            $table->decimal('gj_debit', 15,2)->nullable();
            $table->decimal('gj_credit', 15,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gj_accountcodes_data');
    }
};
