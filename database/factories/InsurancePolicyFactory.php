<?php

namespace Database\Factories;

use App\Models\InsurancePolicy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InsurancePolicy>
 */
class InsurancePolicyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => fake()->title(),
            "description" => fake()->paragraph(),
            "countries" => ["ci","sn"],
            "validity_period_type" => fake()->randomElement(["day", "month", "year"]),
            "validity_period_value" => rand(1, 100),
            "status" => fake()->randomElement(["active", "inactive"]),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (InsurancePolicy $insurancePolicy) {
            $insurancePolicy->fileAttach()->create([
                "path" => "/storage/fake/product02.jpg",
            ]);
        });
    }
}
