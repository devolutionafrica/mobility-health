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
        Schema::create('insured_cards', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('insured_number');
            $table->string('card_number');
            $table->dateTime('issue_date');
            $table->dateTime('expiration_date');
            $table->enum('status',['active','inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insured_cards');
    }
};
