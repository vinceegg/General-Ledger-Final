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
            $table->bigIncrements('gj_id');
            $table->unsignedBigInteger('generaljournal_no');
            $table->foreign('generaljournal_no')->references('generaljournal_no')->on('general_journal')->onDelete('cascade');
            $table->string('gj_accountcode')->nullable();
            $table->decimal('gj_debit', 15,2)->nullable();
            $table->decimal('gj_credit', 15,2)->nullable();
            $table->softDeletes();
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
