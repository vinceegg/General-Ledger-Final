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
            $table->date('gj_entrynum_date')->nullable();
            $table->integer('gj_jevnum')->nullable();
            $table->string('gj_particulars');
            $table->string('gj_accountcode'); 
            $table->decimal('gj_debit' , 15,2)->nullable();
            $table->decimal('gj_credit' , 15,2)->nullable();
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
