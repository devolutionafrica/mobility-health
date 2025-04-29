<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $multiple=[
            "type" => "multiple",
            "question_group_id" => "",
            "question" => [
                "label"=>"",
                "response" => [
                    [
                        "label" => "",
                        "value" => "",
                    ]
                ],
            ],
        ];
        $option=[
            "type" => "option",
            "question_group_id" => "",
            "question" => [
                "label"=>"",
                "response" => [
                    [
                        "label" => "",
                        "type" => "text",
                        "result" => [
                            [
                                "label" => "",
                                "value" => "",
                            ]
                        ],
                    ]

                ],
            ],
        ];
        return [
            'question' => '{"label":"dddd","response":[{"label":"Oui","type":"option","result":[{"label":"Nom","value":false},{"label":"Pr\u00e9noms","value":false}]},{"label":"Non","type":"text","result":[{"label":"Nom","value":""},{"label":"Pr\u00e9noms","value":""}]}]}',
            'type' => 'option',
            "status" => fake()->randomElement(["active", "inactive"]),
        ];
    }

}
