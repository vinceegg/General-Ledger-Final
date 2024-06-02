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
            $table->bigIncrements('generaljournal_no');
            $table->string('gj_jevnum')->nullable();
            $table->date('gj_entrynum_date')->nullable();
            $table->string('gj_particulars')->nullable();
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
