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
        Schema::create('customers', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('lastname');
            $table->string('firstname');
            $table->date('birth_date');
            $table->string('nationality_id');
            $table->string('country_of_residence_id');
            $table->string('email')->unique();
            $table->json('phone_number')->unique();
            $table->json('whatsapp_number')->nullable()->unique();

            $table->dateTime('avatar_refresh')->nullable();
            $table->string('document_type')->nullable();
            $table->string('document_num')->nullable();
            $table->string('document_url')->nullable();
            $table->string('otp',6)->nullable();
            $table->dateTime('otp_expire')->nullable();
            $table->enum('gender', ['male', 'female'])
                ->default('male');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('customers');
    }
};
