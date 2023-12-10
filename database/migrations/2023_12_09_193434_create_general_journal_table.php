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
        Schema::create('general_journal', function (Blueprint $table) {
            $table->id();
            $table->integer('entrynumber')->nullable(); 
            $table->date('date')->nullable();
            $table->integer('jevnumber')->nullable();
            $table->string('particulars');
            $table->string('accountcode');
            $table->decimal('debit')->nullable();
            $table->decimal('credit')->nullable();
            $table->string('Journalcol')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_journal');
    }
};
