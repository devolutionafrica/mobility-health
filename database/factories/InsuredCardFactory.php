<?php

namespace Database\Factories;

use App\Http\Controllers\Api\AuthenticatedStatelessController;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InsuredCard>
 */
class InsuredCardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "insured_number" => self::generateNumber(16),
            "card_number" => self::genererNumeroCarte(),
            "issue_date" => Carbon::now(),
            "expiration_date" => Carbon::now()->addMonths(11),
            "status" => $this->faker->randomElement(['active','inactive']),
        ];
    }

    static function generateNumber(int $length = 4): string
    {
        $otp = '';
        for ($i = 0; $i < $length; $i++) {
            $otp .= mt_rand(0, 9);
        }
        return $otp;
    }

    static function genererNumeroCarte()
    {
        // Générer un préfixe aléatoire de 1 lettre majuscule
        $prefix = chr(mt_rand(65, 90)); // ASCII 65-90 correspond aux lettres majuscules A-Z

        // Générer 12 chiffres aléatoires
        $numbers = "";
        for ($i = 0; $i < 8; $i++) {
            $numbers .= mt_rand(0, 9);
        }

        // Générer un suffixe aléatoire de 2 lettres majuscules
        $suffix = "";
        for ($i = 0; $i < 2; $i++) {
            $suffix .= chr(mt_rand(65, 90)); // ASCII 65-90 correspond aux lettres majuscules A-Z
        }

        // Combiner les parties pour former le numéro de carte
        return $prefix . $numbers . $suffix;
    }
}
