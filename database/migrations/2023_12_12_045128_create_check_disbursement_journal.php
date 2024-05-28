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
        Schema::create('check_disbursement_journal', function (Blueprint $table) {
            $table->string('ckdj_checknum')->primary();
            $table->date('ckdj_entrynum_date')->nullable();      
            $table->string('ckdj_payee')->nullable();
            $table->integer('ckdj_bur')->nullable();
            $table->decimal('ckdj_cib_lcca',15,2)->nullable();
            $table->decimal('ckdj_account1',15,2)->nullable();
            $table->decimal('ckdj_account2',15,2)->nullable();
            $table->decimal('ckdj_account3',15,2)->nullable();
            $table->decimal('ckdj_salary_wages',15,2)->nullable();
            $table->decimal('ckdj_honoraria',15,2)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('check_disbursement_journal');
    }
};
