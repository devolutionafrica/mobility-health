<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\FileAttach;
use App\Models\InsuredCard;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "lastname" => fake()->lastName(),
            "firstname" => fake()->lastName(),
            "birth_date" => Carbon::now()->addDays($this->faker->numberBetween(1, 30)),
            "nationality_id" => fake()->randomElement([
                'dz', // Algérie
                'eg', // Égypte
                'ly', // Libye
                'ma', // Maroc
                'sd', // Soudan
                'tn', // Tunisie

                // Afrique de l'Ouest
                'bj', // Bénin
                'bf', // Burkina Faso
                'cv', // Cap-Vert
                'ci', // Côte d'Ivoire
                'gm', // Gambie
                'gh', // Ghana
                'gn', // Guinée
                'gw', // Guinée-Bissau
                'lr', // Liberia
                'ml', // Mali
                'mr', // Mauritanie
                'ne', // Niger
                'ng', // Nigeria
                'sn', // Sénégal
                'sl', // Sierra Leone
                'tg', // Togo

                // Afrique Centrale
                'ao', // Angola
                'cm', // Cameroun
                'cf', // République Centrafricaine
                'td', // Tchad
                'cg', // Congo-Brazzaville
                'cd', // République Démocratique du Congo
                'gq', // Guinée Équatoriale
                'ga', // Gabon
                'st', // Sao Tomé-et-Principe

                // Afrique de l'Est
                'bi', // Burundi
                'km', // Comores
                'dj', // Djibouti
                'er', // Érythrée
                'et', // Éthiopie
                'ke', // Kenya
                'mg', // Madagascar
                'mw', // Malawi
                'mu', // Maurice
                'mz', // Mozambique
                'rw', // Rwanda
                'sc', // Seychelles
                'so', // Somalie
                'ss', // Soudan du Sud
                'tz', // Tanzanie
                'ug', // Ouganda
                'zm', // Zambie
                'zw', // Zimbabwe
            ]),
            "country_of_residence_id" => fake()->randomElement([
                'dz', // Algérie
                'eg', // Égypte
                'ly', // Libye
                'ma', // Maroc
                'sd', // Soudan
                'tn', // Tunisie

                // Afrique de l'Ouest
                'bj', // Bénin
                'bf', // Burkina Faso
                'cv', // Cap-Vert
                'ci', // Côte d'Ivoire
                'gm', // Gambie
                'gh', // Ghana
                'gn', // Guinée
                'gw', // Guinée-Bissau
                'lr', // Liberia
                'ml', // Mali
                'mr', // Mauritanie
                'ne', // Niger
                'ng', // Nigeria
                'sn', // Sénégal
                'sl', // Sierra Leone
                'tg', // Togo

                // Afrique Centrale
                'ao', // Angola
                'cm', // Cameroun
                'cf', // République Centrafricaine
                'td', // Tchad
                'cg', // Congo-Brazzaville
                'cd', // République Démocratique du Congo
                'gq', // Guinée Équatoriale
                'ga', // Gabon
                'st', // Sao Tomé-et-Principe

                // Afrique de l'Est
                'bi', // Burundi
                'km', // Comores
                'dj', // Djibouti
                'er', // Érythrée
                'et', // Éthiopie
                'ke', // Kenya
                'mg', // Madagascar
                'mw', // Malawi
                'mu', // Maurice
                'mz', // Mozambique
                'rw', // Rwanda
                'sc', // Seychelles
                'so', // Somalie
                'ss', // Soudan du Sud
                'tz', // Tanzanie
                'ug', // Ouganda
                'zm', // Zambie
                'zw', // Zimbabwe
            ]),

            "phone_number" => fake()->phoneNumber(),
            "whatsapp_number" => fake()->phoneNumber(),
            "email" => fake()->email(),
            "avatar_refresh" => Carbon::now()->addMonths($this->faker->numberBetween(1, 4)),
            "document_type" => fake()->randomElement(["cni", "passport", "other"]),
            "document_num" => fake()->numberBetween(100000, 999999),
            "document_url" => fake()->imageUrl(),
            'gender' => fake()->randomElement(['male', 'female']),
        ];
    }

     public function configure(): static
    {
        return $this->afterCreating(function (Customer $customer) {
           $customer->avatar()->create([
               "path" => "fake/user.png",
           ]);
            InsuredCard::factory()->create([
                "customer_id" => $customer->id,
            ]);
        });
    }
}
