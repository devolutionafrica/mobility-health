subscriptions<?php

use App\Models\CardType;
use App\Models\Country;
use App\Models\Customer;
use App\Models\GeographicArea;
use App\Models\InsurancePolicy;
use App\Models\Login;
use App\Models\Question;
use App\Models\QuestionGroup;
use App\Models\Speciality;
use App\Models\Subscription;
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
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->foreignIdFor(Customer::class)->constrained();
            $table->foreignIdFor(InsurancePolicy::class)->constrained();
        });
        Schema::table('insured_cards', function (Blueprint $table) {
            $table->foreignIdFor(Subscription::class)->constrained();
        });

        Schema::create('card_type_question', function (Blueprint $table) {
            $table->foreignIdFor(Question::class)->constrained();
            $table->foreignIdFor(CardType::class)->constrained();
        });
        Schema::create('geographic_area_countries', function (Blueprint $table) {
            $table->foreignIdFor(GeographicArea::class)->constrained();
            $table->string("country_id");
            $table->enum("status", ["active", "inactive"])->default("active");
        });
        Schema::table('packages', function (Blueprint $table) {
            $table->foreignIdFor(InsurancePolicy::class)->constrained();
            $table->foreignIdFor(GeographicArea::class)->constrained();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreignUlid("speciality_id")->nullable()
                ->references('id')
                ->on('specialities');
            //$table->foreignIdFor(Speciality::class)->nullable()->constrained();
        });
        Schema::table('questions', function (Blueprint $table) {
            $table->foreignIdFor(QuestionGroup::class)->nullable()->constrained();
        });
        Schema::table('customers', function (Blueprint $table) {
            $table->foreign('nationality_id')
                ->references('id')
                ->on('countries');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_type_question');
        Schema::dropIfExists('geographic_area_countries');
    }
};
