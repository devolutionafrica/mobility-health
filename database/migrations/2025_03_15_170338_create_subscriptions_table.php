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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('insurance_policy_ref');
            $table->string('destination_option');
            $table->string('zone_ref');
            $table->string('package_ref');
            $table->string('emit_date');
            $table->string('residence_id');
            $table->string('departure_code');
            $table->string('destination_code');
            $table->string('payment_method');
            $table->json('whatsapp')->nullable();
            $table->json('phone')->nullable();
            $table->json('period')->nullable();//type,value
            $table->double("price");

            $table->dateTime("date_start")->nullable();
            $table->dateTime("date_end")->nullable();
            $table->enum("status", ["pending", "validate","cancel","reject"])->default("pending");
            $table->string("status_message")->nullable();


            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
