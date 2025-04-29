<?php

namespace Database\Seeders;

use App\Models\CardType;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Enums\GeographicAreaType;
use App\Models\Enums\Status;
use App\Models\GeographicArea;
use App\Models\InsurancePolicy;
use App\Models\Question;
use App\Models\QuestionGroup;
use App\Models\Speciality;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $questionGroups = [
            "Historique Médical" => [
                "page" => 1,
                "type" => "complementary",
                "quiz" => [
                    [
                        "type" => "multiple",
                        "question" => [
                            "ref" => Str::uuid(),
                            "label" => "Avez-vous actuellement ou avez-vous déjà souffert des maladies suivantes :",
                            "response" => [
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Hypertension artérielle",
                                    "value" => "",
                                ],
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Diabète",
                                    "value" => "",
                                ],
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Maladies cardiaques (Précisez)",
                                    "value" => "",
                                ],
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Maladies respiratoires (ex : asthme, bronchite chronique)",
                                    "value" => "",
                                ],
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Maladies neurologiques (ex : épilepsie) ",
                                    "value" => "",
                                ],
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Maladies chroniques (ex : hépatite, insuffisance rénale)",
                                    "value" => "",
                                ],
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Aucune de ces maladies",
                                    "value" => "",
                                ]
                            ],
                        ],
                    ],
                    [
                        "type" => "option",
                        "question" => [
                            "ref" => Str::uuid(),
                            "label" => "Êtes-vous en traitement médical régulier?",
                            "response" => [
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Oui",
                                    "type" => "text",
                                    "result" => [
                                        [
                                            "ref" => Str::uuid(),
                                            "label" => "Précisez le type de traitement ",
                                            "value" => "",
                                        ],

                                    ],
                                ],
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Non",
                                    "type" => "text",
                                    "result" => [],
                                ]
                            ],
                        ],
                    ],
                    [
                        "type" => "option",
                        "question" => [
                            "ref" => Str::uuid(),
                            "label" => "Avez-vous été hospitalisé au cours des 12 derniers mois?",
                            "response" => [
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Oui",
                                    "type" => "text",
                                    "result" => [
                                        [
                                            "ref" => Str::uuid(),
                                            "label" => "Précisez pour quelle raison",
                                            "value" => "",
                                        ],
                                    ],
                                ],
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Non",
                                    "type" => "text",
                                    "result" => [],
                                ]

                            ],
                        ],
                    ]
                ]
            ],
            "Santé actuelle" => [
                "page" => 2,
                "type" => "complementary",
                "quiz" => [
                    [
                        "type" => "option",
                        "question" => [
                            "ref" => Str::uuid(),
                            "label" => "•	Êtes-vous malade au moment de la souscription de cette police?",
                            "response" => [
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Oui",
                                    "type" => "text",
                                    "result" => [
                                        [
                                            "ref" => Str::uuid(),
                                            "label" => "Précisez de quoi souffrez-vous?",
                                            "value" => "",
                                        ],
                                    ],
                                ],
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Non",
                                    "type" => "text",
                                    "result" => [],
                                ]
                            ],
                        ],
                    ],
                    [
                        "type" => "option",
                        "question" => [
                            "ref" => Str::uuid(),
                            "label" => "Ressentez-vous actuellement des symptômes persistants? (douleurs, essoufflements, etc)",
                            "response" => [
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Oui",
                                    "type" => "text",
                                    "result" => [
                                        [
                                            "ref" => Str::uuid(),
                                            "label" => "Précisez",
                                            "value" => "",
                                        ],
                                    ],
                                ],
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Non",
                                    "type" => "text",
                                    "result" => [],
                                ]
                            ],
                        ],
                    ],
                    [
                        "type" => "option",
                        "question" => [
                            "ref" => Str::uuid(),
                            "label" => "Avez-vous un médecin traitant",
                            "response" => [
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Oui",
                                    "type" => "text",
                                    "result" => [
                                        [
                                            "ref" => Str::uuid(),
                                            "label" => "son nom",
                                            "value" => "",
                                        ],
                                        [
                                            "ref" => Str::uuid(),
                                            "label" => "Spécialité",
                                            "value" => "",
                                        ],
                                        [
                                            "ref" => Str::uuid(),
                                            "label" => "Téléphone",
                                            "value" => "",
                                        ],
                                    ],
                                ],
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Non",
                                    "type" => "text",
                                    "result" => [],
                                ]
                            ],
                        ],
                    ],
                ]
            ],
            "Mode de vie" => [
                "page" => 3,
                "type" => "complementary",
                "quiz" => [
                    [
                        "type" => "option",
                        "question" => [
                            "ref" => Str::uuid(),
                            "label" => "Fumez-vous?",
                            "response" => [
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Oui",
                                    "type" => "text",
                                    "result" => [
                                        [
                                            "ref" => Str::uuid(),
                                            "label" => "Combien de cigarettes par jour?",
                                            "value" => "",
                                        ],
                                    ],
                                ],
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Non",
                                    "type" => "text",
                                    "result" => [],
                                ]
                            ],
                        ],
                    ],
                    [
                        "type" => "option",
                        "question" => [
                            "ref" => Str::uuid(),
                            "label" => "Consommez-vous de l’alcool",
                            "response" => [
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Oui",
                                    "type" => "option",
                                    "result" => [
                                        [
                                            "ref" => Str::uuid(),
                                            "label" => "Occasionnellement",
                                            "value" => "",
                                        ],
                                        [
                                            "ref" => Str::uuid(),
                                            "label" => "Régulièrement (1 à 2 fois par semaine)",
                                            "value" => "",
                                        ],
                                        [
                                            "ref" => Str::uuid(),
                                            "label" => "Quotidiennement",
                                            "value" => "",
                                        ],
                                    ],
                                ],
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Non",
                                    "type" => "text",
                                    "result" => [],
                                ]
                            ],
                        ],
                    ],
                    [
                        "type" => "option",
                        "question" => [
                            "ref" => Str::uuid(),
                            "label" => "Pratiquez-vous une activité physique régulièrement?",
                            "response" => [
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Oui",
                                    "type" => "text",
                                    "result" => [
                                        [
                                            "ref" => Str::uuid(),
                                            "label" => "Laquelle et à quelle fréquence?",
                                            "value" => "",
                                        ],
                                    ],
                                ],
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Non",
                                    "type" => "text",
                                    "result" => [],
                                ]
                            ],
                        ],
                    ],
                ]
            ],
            "Allergies et intolérances" => [
                "page" => 4,
                "type" => "complementary",
                "quiz" => [
                    [
                        "type" => "option",
                        "question" => [
                            "ref" => Str::uuid(),
                            "label" => "Êtes-vous allergique à certains médicaments, aliments, ou autres substances",
                            "response" => [
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Oui",
                                    "type" => "text",
                                    "result" => [
                                        [
                                            "ref" => Str::uuid(),
                                            "label" => "Précisez :",
                                            "value" => "",
                                        ],
                                    ],
                                ],
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Non",
                                    "type" => "text",
                                    "result" => [],
                                ]
                            ],
                        ],
                    ],
                ]
            ],
            "Santé mentale" => [
                "page" => 4,
                "type" => "complementary",
                "quiz" => [
                    [
                        "type" => "option",
                        "question" => [
                            "ref" => Str::uuid(),
                            "label" => "Avez-vous déjà été diagnostiqué(e) pour un trouble mental ou émotionnel (anxiété, dépression, etc)",
                            "response" => [
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Oui",
                                    "type" => "text",
                                    "result" => [
                                        [
                                            "ref" => Str::uuid(),
                                            "label" => "Précisez :",
                                            "value" => "",
                                        ],
                                    ],
                                ],
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Non",
                                    "type" => "text",
                                    "result" => [],
                                ]
                            ],
                        ],
                    ],
                ]
            ],
            "Questions de santé" => [
                "page" => 1,
                "type" => "register",
                "quiz" => [
                    [
                        "type" => "option",
                        "question" => [
                            "ref" => Str::uuid(),
                            "label" => "Fumez-vous?",
                            "response" => [
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Oui",
                                    "type" => "text",
                                    "result" => [
                                        [
                                            "ref" => Str::uuid(),
                                            "label" => "Combien de cigarettes par jour?",
                                            "value" => "",
                                        ],
                                    ],
                                ],
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Non",
                                    "type" => "text",
                                    "result" => [],
                                ]
                            ],
                        ],
                    ],
                    [
                        "type" => "option",
                        "question" => [
                            "ref" => Str::uuid(),
                            "label" => "Consommez-vous de l’alcool",
                            "response" => [
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Oui",
                                    "type" => "option",
                                    "result" => [
                                        [
                                            "ref" => Str::uuid(),
                                            "label" => "Occasionnellement",
                                            "value" => "",
                                        ],
                                        [
                                            "ref" => Str::uuid(),
                                            "label" => "Régulièrement (1 à 2 fois par semaine)",
                                            "value" => "",
                                        ],
                                        [
                                            "ref" => Str::uuid(),
                                            "label" => "Quotidiennement",
                                            "value" => "",
                                        ],
                                    ],
                                ],
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Non",
                                    "type" => "text",
                                    "result" => [],
                                ]
                            ],
                        ],
                    ],
                    [
                        "type" => "option",
                        "question" => [
                            "ref" => Str::uuid(),
                            "label" => "Pratiquez-vous une activité physique régulièrement?",
                            "response" => [
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Oui",
                                    "type" => "text",
                                    "result" => [
                                        [
                                            "ref" => Str::uuid(),
                                            "label" => "Laquelle et à quelle fréquence?",
                                            "value" => "",
                                        ],
                                    ],
                                ],
                                [
                                    "ref" => Str::uuid(),
                                    "label" => "Non",
                                    "type" => "text",
                                    "result" => [],
                                ]
                            ],
                        ],
                    ],
                ]
            ],
        ];

        $countries= [
            ['name' => 'Afrique du Sud', 'nationality' => 'Sud-Africaine', 'iso' => 'za', 'phone_prefix' => '+27'],
            ['name' => 'Algérie', 'nationality' => 'Algérienne', 'iso' => 'dz', 'phone_prefix' => '+213'],
            ['name' => 'Angola', 'nationality' => 'Angolaise', 'iso' => 'ao', 'phone_prefix' => '+244'],
            ['name' => 'Bénin', 'nationality' => 'Béninoise', 'iso' => 'bj', 'phone_prefix' => '+229'],
            ['name' => 'Botswana', 'nationality' => 'Botswanaise', 'iso' => 'bw', 'phone_prefix' => '+267'],
            ['name' => 'Burkina Faso', 'nationality' => 'Burkinabé', 'iso' => 'bf', 'phone_prefix' => '+226'],
            ['name' => 'Burundi', 'nationality' => 'Burundaise', 'iso' => 'bi', 'phone_prefix' => '+257'],
            ['name' => 'Cameroun', 'nationality' => 'Camerounaise', 'iso' => 'cm', 'phone_prefix' => '+237'],
            ['name' => 'Cap-Vert', 'nationality' => 'Cap-Verdienne', 'iso' => 'cv', 'phone_prefix' => '+238'],
            ['name' => 'République centrafricaine', 'nationality' => 'Centrafricaine', 'iso' => 'cf', 'phone_prefix' => '+236'],
            ['name' => 'Comores', 'nationality' => 'Comorienne', 'iso' => 'km', 'phone_prefix' => '+269'],
            ['name' => 'Congo-Brazzaville', 'nationality' => 'Congolaise', 'iso' => 'cg', 'phone_prefix' => '+242'],
            ['name' => 'Congo-Kinshasa', 'nationality' => 'Congolaise', 'iso' => 'cd', 'phone_prefix' => '+243'],
            ['name' => 'Côte d\'Ivoire', 'nationality' => 'Ivoirienne', 'iso' => 'ci', 'phone_prefix' => '+225'],
            ['name' => 'Djibouti', 'nationality' => 'Djiboutienne', 'iso' => 'dj', 'phone_prefix' => '+253'],
            ['name' => 'Égypte', 'nationality' => 'Égyptienne', 'iso' => 'eg', 'phone_prefix' => '+20'],
            ['name' => 'Érythrée', 'nationality' => 'Érythréenne', 'iso' => 'er', 'phone_prefix' => '+291'],
            ['name' => 'Eswatini', 'nationality' => 'Swazi', 'iso' => 'sz', 'phone_prefix' => '+268'],
            ['name' => 'Éthiopie', 'nationality' => 'Éthiopienne', 'iso' => 'et', 'phone_prefix' => '+251'],
            ['name' => 'Gabon', 'nationality' => 'Gabonaise', 'iso' => 'ga', 'phone_prefix' => '+241'],
            ['name' => 'Gambie', 'nationality' => 'Gambienne', 'iso' => 'gm', 'phone_prefix' => '+220'],
            ['name' => 'Ghana', 'nationality' => 'Ghanéenne', 'iso' => 'gh', 'phone_prefix' => '+233'],
            ['name' => 'Guinée', 'nationality' => 'Guinéenne', 'iso' => 'gn', 'phone_prefix' => '+224'],
            ['name' => 'Guinée-Bissau', 'nationality' => 'Bissaoguinéenne', 'iso' => 'gw', 'phone_prefix' => '+245'],
            ['name' => 'Guinée équatoriale', 'nationality' => 'Équato-Guinéenne', 'iso' => 'gq', 'phone_prefix' => '+240'],
            ['name' => 'Kenya', 'nationality' => 'Kényane', 'iso' => 'ke', 'phone_prefix' => '+254'],
            ['name' => 'Lesotho', 'nationality' => 'Lesothane', 'iso' => 'ls', 'phone_prefix' => '+266'],
            ['name' => 'Libéria', 'nationality' => 'Libérienne', 'iso' => 'lr', 'phone_prefix' => '+231'],
            ['name' => 'Libye', 'nationality' => 'Libyenne', 'iso' => 'ly', 'phone_prefix' => '+218'],
            ['name' => 'Madagascar', 'nationality' => 'Malagasy', 'iso' => 'mg', 'phone_prefix' => '+261'],
            ['name' => 'Malawi', 'nationality' => 'Malawite', 'iso' => 'mw', 'phone_prefix' => '+265'],
            ['name' => 'Mali', 'nationality' => 'Malienne', 'iso' => 'ml', 'phone_prefix' => '+223'],
            ['name' => 'Maroc', 'nationality' => 'Marocaine', 'iso' => 'ma', 'phone_prefix' => '+212'],
            ['name' => 'Maurice', 'nationality' => 'Mauricienne', 'iso' => 'mu', 'phone_prefix' => '+230'],
            ['name' => 'Mauritanie', 'nationality' => 'Mauritanienne', 'iso' => 'mr', 'phone_prefix' => '+222'],
            ['name' => 'Mozambique', 'nationality' => 'Mozambicaine', 'iso' => 'mz', 'phone_prefix' => '+258'],
            ['name' => 'Namibie', 'nationality' => 'Namibienne', 'iso' => 'na', 'phone_prefix' => '+264'],
            ['name' => 'Niger', 'nationality' => 'Nigérienne', 'iso' => 'ne', 'phone_prefix' => '+227'],
            ['name' => 'Nigeria', 'nationality' => 'Nigériane', 'iso' => 'ng', 'phone_prefix' => '+234'],
            ['name' => 'Ouganda', 'nationality' => 'Ougandaise', 'iso' => 'ug', 'phone_prefix' => '+256'],
            ['name' => 'Rwanda', 'nationality' => 'Rwandaise', 'iso' => 'rw', 'phone_prefix' => '+250'],
            ['name' => 'Sao Tomé-et-Principe', 'nationality' => 'Santoméenne', 'iso' => 'st', 'phone_prefix' => '+239'],
            ['name' => 'Sénégal', 'nationality' => 'Sénégalaise', 'iso' => 'sn', 'phone_prefix' => '+221'],
            ['name' => 'Seychelles', 'nationality' => 'Seychelloise', 'iso' => 'sc', 'phone_prefix' => '+248'],
            ['name' => 'Sierra Leone', 'nationality' => 'Sierra-Léonaise', 'iso' => 'sl', 'phone_prefix' => '+232'],
            ['name' => 'Somalie', 'nationality' => 'Somalienne', 'iso' => 'so', 'phone_prefix' => '+252'],
            ['name' => 'Soudan', 'nationality' => 'Soudanaise', 'iso' => 'sd', 'phone_prefix' => '+249'],
            ['name' => 'Soudan du Sud', 'nationality' => 'Sud-Soudanaise', 'iso' => 'ss', 'phone_prefix' => '+211'],
            ['name' => 'Tanzanie', 'nationality' => 'Tanzanienne', 'iso' => 'tz', 'phone_prefix' => '+255'],
            ['name' => 'Tchad', 'nationality' => 'Tchadienne', 'iso' => 'td', 'phone_prefix' => '+235'],
            ['name' => 'Togo', 'nationality' => 'Togolaise', 'iso' => 'tg', 'phone_prefix' => '+228'],
            ['name' => 'Tunisie', 'nationality' => 'Tunisienne', 'iso' => 'tn', 'phone_prefix' => '+216'],
            ['name' => 'Zambie', 'nationality' => 'Zambienne', 'iso' => 'zm', 'phone_prefix' => '+260'],
            ['name' => 'Zimbabwe', 'nationality' => 'Zimbabwéenne', 'iso' => 'zw', 'phone_prefix' => '+263'],
            ['name' => 'Émirats Arabes Unis', 'nationality' => 'Émirienne', 'iso' => 'ae', 'phone_prefix' => '+971'],
            ['name' => 'Inde', 'nationality' => 'Indienne', 'iso' => 'in', 'phone_prefix' => '+91'],
            ['name' => 'Chine', 'nationality' => 'Chinoise', 'iso' => 'cn', 'phone_prefix' => '+86'],
            ['name' => 'Turquie', 'nationality' => 'Turque', 'iso' => 'tr', 'phone_prefix' => '+90'],
        ];

        foreach ($questionGroups as $title => $questionGroup) {
            $qg = QuestionGroup::create([
                "title" => $title,
                "question_type" => $questionGroup["type"],
                "page" => $questionGroup["page"],
            ]);
            foreach ($questionGroup["quiz"] as $question) {
                Question::query()->create([
                    ...$question,
                    "question_group_id" => $qg->id,
                ]);
            }
        }

        /*$countries = [
            ['name' => 'Afrique du Sud', 'nationality' => 'Sud-Africain', 'iso' => 'za', 'unicode_pair' => 'U+1F1FF U+1F1E6', 'phone_prefix' => '+27'],
            ['name' => 'Algérie', 'nationality' => 'Algérien', 'iso' => 'dz', 'unicode_pair' => 'U+1F1E9 U+1F1FF', 'phone_prefix' => '+213'],
            ['name' => 'Angola', 'nationality' => 'Angolais', 'iso' => 'ao', 'unicode_pair' => 'U+1F1E6 U+1F1F4', 'phone_prefix' => '+244'],
            ['name' => 'Bénin', 'nationality' => 'Béninois', 'iso' => 'bj', 'unicode_pair' => 'U+1F1E7 U+1F1EF', 'phone_prefix' => '+229'],
            ['name' => 'Botswana', 'nationality' => 'Botswanais', 'iso' => 'bw', 'unicode_pair' => 'U+1F1E7 U+1F1FC', 'phone_prefix' => '+267'],
            ['name' => 'Burkina Faso', 'nationality' => 'Burkinabé', 'iso' => 'bf', 'unicode_pair' => 'U+1F1E7 U+1F1EB', 'phone_prefix' => '+226'],
            ['name' => 'Burundi', 'nationality' => 'Burundais', 'iso' => 'bi', 'unicode_pair' => 'U+1F1E7 U+1F1EE', 'phone_prefix' => '+257'],
            ['name' => 'Cameroun', 'nationality' => 'Camerounais', 'iso' => 'cm', 'unicode_pair' => 'U+1F1E8 U+1F1F2', 'phone_prefix' => '+237'],
            ['name' => 'Cap-Vert', 'nationality' => 'Cap-Verdien', 'iso' => 'cv', 'unicode_pair' => 'U+1F1E8 U+1F1FB', 'phone_prefix' => '+238'],
            ['name' => 'République centrafricaine', 'nationality' => 'Centrafricain', 'iso' => 'cf', 'unicode_pair' => 'U+1F1E8 U+1F1EB', 'phone_prefix' => '+236'],
            ['name' => 'Comores', 'nationality' => 'Comorien', 'iso' => 'km', 'unicode_pair' => 'U+1F1F0 U+1F1F2', 'phone_prefix' => '+269'],
            ['name' => 'Congo-Brazzaville', 'nationality' => 'Congolais', 'iso' => 'cg', 'unicode_pair' => 'U+1F1E8 U+1F1EC', 'phone_prefix' => '+242'],
            ['name' => 'Congo-Kinshasa', 'nationality' => 'Congolais', 'iso' => 'cd', 'unicode_pair' => 'U+1F1E8 U+1F1E9', 'phone_prefix' => '+243'],
            ['name' => 'Côte d\'Ivoire', 'nationality' => 'Ivoirien', 'iso' => 'ci', 'unicode_pair' => 'U+1F1E8 U+1F1EE', 'phone_prefix' => '+225'],
            ['name' => 'Djibouti', 'nationality' => 'Djiboutien', 'iso' => 'dj', 'unicode_pair' => 'U+1F1E9 U+1F1EF', 'phone_prefix' => '+253'],
            ['name' => 'Égypte', 'nationality' => 'Égyptien', 'iso' => 'eg', 'unicode_pair' => 'U+1F1EA U+1F1EC', 'phone_prefix' => '+20'],
            ['name' => 'Érythrée', 'nationality' => 'Érythréen', 'iso' => 'er', 'unicode_pair' => 'U+1F1EA U+1F1F7', 'phone_prefix' => '+291'],
            ['name' => 'Eswatini', 'nationality' => 'Swazi', 'iso' => 'sz', 'unicode_pair' => 'U+1F1F8 U+1F1FF', 'phone_prefix' => '+268'],
            ['name' => 'Éthiopie', 'nationality' => 'Éthiopien', 'iso' => 'et', 'unicode_pair' => 'U+1F1EA U+1F1F9', 'phone_prefix' => '+251'],
            ['name' => 'Gabon', 'nationality' => 'Gabonais', 'iso' => 'ga', 'unicode_pair' => 'U+1F1EC U+1F1E6', 'phone_prefix' => '+241'],
            ['name' => 'Gambie', 'nationality' => 'Gambien', 'iso' => 'gm', 'unicode_pair' => 'U+1F1EC U+1F1F2', 'phone_prefix' => '+220'],
            ['name' => 'Ghana', 'nationality' => 'Ghanéen', 'iso' => 'gh', 'unicode_pair' => 'U+1F1EC U+1F1ED', 'phone_prefix' => '+233'],
            ['name' => 'Guinée', 'nationality' => 'Guinéen', 'iso' => 'gn', 'unicode_pair' => 'U+1F1EC U+1F1F3', 'phone_prefix' => '+224'],
            ['name' => 'Guinée-Bissau', 'nationality' => 'Bissaoguinéen', 'iso' => 'gw', 'unicode_pair' => 'U+1F1EC U+1F1FC', 'phone_prefix' => '+245'],
            ['name' => 'Guinée équatoriale', 'nationality' => 'Équato-Guinéen', 'iso' => 'gq', 'unicode_pair' => 'U+1F1EC U+1F1F6', 'phone_prefix' => '+240'],
            ['name' => 'Kenya', 'nationality' => 'Kényan', 'iso' => 'ke', 'unicode_pair' => 'U+1F1F0 U+1F1EA', 'phone_prefix' => '+254'],
            ['name' => 'Lesotho', 'nationality' => 'Lesothan', 'iso' => 'ls', 'unicode_pair' => 'U+1F1F1 U+1F1F8', 'phone_prefix' => '+266'],
            ['name' => 'Libéria', 'nationality' => 'Libérien', 'iso' => 'lr', 'unicode_pair' => 'U+1F1F1 U+1F1F7', 'phone_prefix' => '+231'],
            ['name' => 'Libye', 'nationality' => 'Libyen', 'iso' => 'ly', 'unicode_pair' => 'U+1F1F1 U+1F1FE', 'phone_prefix' => '+218'],
            ['name' => 'Madagascar', 'nationality' => 'Malagasy', 'iso' => 'mg', 'unicode_pair' => 'U+1F1F2 U+1F1EC', 'phone_prefix' => '+261'],
            ['name' => 'Malawi', 'nationality' => 'Malawite', 'iso' => 'mw', 'unicode_pair' => 'U+1F1F2 U+1F1FC', 'phone_prefix' => '+265'],
            ['name' => 'Mali', 'nationality' => 'Malien', 'iso' => 'ml', 'unicode_pair' => 'U+1F1F2 U+1F1F1', 'phone_prefix' => '+223'],
            ['name' => 'Maroc', 'nationality' => 'Marocain', 'iso' => 'ma', 'unicode_pair' => 'U+1F1F2 U+1F1E6', 'phone_prefix' => '+212'],
            ['name' => 'Maurice', 'nationality' => 'Mauricien', 'iso' => 'mu', 'unicode_pair' => 'U+1F1F2 U+1F1FA', 'phone_prefix' => '+230'],
            ['name' => 'Mauritanie', 'nationality' => 'Mauritanien', 'iso' => 'mr', 'unicode_pair' => 'U+1F1F2 U+1F1F7', 'phone_prefix' => '+222'],
            ['name' => 'Mozambique', 'nationality' => 'Mozambicain', 'iso' => 'mz', 'unicode_pair' => 'U+1F1F2 U+1F1FF', 'phone_prefix' => '+258'],
            ['name' => 'Namibie', 'nationality' => 'Namibien', 'iso' => 'na', 'unicode_pair' => 'U+1F1F3 U+1F1E6', 'phone_prefix' => '+264'],
            ['name' => 'Niger', 'nationality' => 'Nigérien', 'iso' => 'ne', 'unicode_pair' => 'U+1F1F3 U+1F1EA', 'phone_prefix' => '+227'],
            ['name' => 'Nigeria', 'nationality' => 'Nigérian', 'iso' => 'ng', 'unicode_pair' => 'U+1F1F3 U+1F1EC', 'phone_prefix' => '+234'],
            ['name' => 'Ouganda', 'nationality' => 'Ougandais', 'iso' => 'ug', 'unicode_pair' => 'U+1F1FA U+1F1EC', 'phone_prefix' => '+256'],
            ['name' => 'Rwanda', 'nationality' => 'Rwandais', 'iso' => 'rw', 'unicode_pair' => 'U+1F1F7 U+1F1FC', 'phone_prefix' => '+250'],
            ['name' => 'Sao Tomé-et-Principe', 'nationality' => 'Santoméen', 'iso' => 'st', 'unicode_pair' => 'U+1F1F8 U+1F1F9', 'phone_prefix' => '+239'],
            ['name' => 'Sénégal', 'nationality' => 'Sénégalais', 'iso' => 'sn', 'unicode_pair' => 'U+1F1F8 U+1F1F3', 'phone_prefix' => '+221'],
            ['name' => 'Seychelles', 'nationality' => 'Seychellois', 'iso' => 'sc', 'unicode_pair' => 'U+1F1F8 U+1F1E8', 'phone_prefix' => '+248'],
            ['name' => 'Sierra Leone', 'nationality' => 'Sierra-Léonais', 'iso' => 'sl', 'unicode_pair' => 'U+1F1F8 U+1F1F1', 'phone_prefix' => '+232'],
            ['name' => 'Somalie', 'nationality' => 'Somalien', 'iso' => 'so', 'unicode_pair' => 'U+1F1F8 U+1F1F4', 'phone_prefix' => '+252'],
            ['name' => 'Soudan', 'nationality' => 'Soudanais', 'iso' => 'sd', 'unicode_pair' => 'U+1F1F8 U+1F1E9', 'phone_prefix' => '+249'],
            ['name' => 'Soudan du Sud', 'nationality' => 'Sud-Soudanais', 'iso' => 'ss', 'unicode_pair' => 'U+1F1F8 U+1F1F8', 'phone_prefix' => '+211'],
            ['name' => 'Tanzanie', 'nationality' => 'Tanzanien', 'iso' => 'tz', 'unicode_pair' => 'U+1F1F9 U+1F1FF', 'phone_prefix' => '+255'],
            ['name' => 'Tchad', 'nationality' => 'Tchadien', 'iso' => 'td', 'unicode_pair' => 'U+1F1F9 U+1F1E9', 'phone_prefix' => '+235'],
            ['name' => 'Togo', 'nationality' => 'Togolais', 'iso' => 'tg', 'unicode_pair' => 'U+1F1F9 U+1F1EC', 'phone_prefix' => '+228'],
            ['name' => 'Tunisie', 'nationality' => 'Tunisien', 'iso' => 'tn', 'unicode_pair' => 'U+1F1F9 U+1F1F3', 'phone_prefix' => '+216'],
            ['name' => 'Zambie', 'nationality' => 'Zambien', 'iso' => 'zm', 'unicode_pair' => 'U+1F1FF U+1F1F2', 'phone_prefix' => '+260'],
            ['name' => 'Zimbabwe', 'nationality' => 'Zimbabwéen', 'iso' => 'zw', 'unicode_pair' => 'U+1F1FF U+1F1FC', 'phone_prefix' => '+263'],
            ['name' => 'Émirats Arabes Unis', 'nationality' => 'Emirati', 'iso' => 'ae', 'unicode_pair' => 'U+1F1E6 U+1F1EA', 'phone_prefix' => '+971'],
            ['name' => 'Inde', 'nationality' => 'Indien', 'iso' => 'in', 'unicode_pair' => 'U+1F1EE U+1F1F3', 'phone_prefix' => '+91'],
            ['name' => 'Chine', 'nationality' => 'Chinois', 'iso' => 'cn', 'unicode_pair' => 'U+1F1E8 U+1F1F3', 'phone_prefix' => '+86'],
            ['name' => 'Turquie', 'nationality' => 'Turc', 'iso' => 'tr', 'unicode_pair' => 'U+1F1F9 U+1F1F7', 'phone_prefix' => '+90'],
        ];*/
        $specialites = [
            [
                'nom' => 'Médecine Générale',
                'description' => 'Fournit des soins de santé primaires à des patients de tous âges et gère un large éventail de problèmes médicaux. C\'est souvent le premier point de contact pour les patients.'
            ],
            [
                'nom' => 'Cardiologie',
                'description' => 'Spécialiste du cœur et des vaisseaux sanguins.'
            ],
            [
                'nom' => 'Dermatologie',
                'description' => 'Spécialiste de la peau, des cheveux et des ongles.'
            ],
            [
                'nom' => 'Endocrinologie',
                'description' => 'Spécialiste des hormones et des troubles métaboliques (diabète, thyroïde...).'
            ],
            [
                'nom' => 'Gastro-entérologie',
                'description' => 'Spécialiste du système digestif.'
            ],
            [
                'nom' => 'Gériatrie',
                'description' => 'Spécialiste des soins aux personnes âgées.'
            ],
            [
                'nom' => 'Gynécologie-Obstétrique',
                'description' => 'Spécialiste de la santé de la femme, de la grossesse et de l\'accouchement.'
            ],
            [
                'nom' => 'Hématologie',
                'description' => 'Spécialiste des maladies du sang.'
            ],
            [
                'nom' => 'Hépato-gastro-entérologie',
                'description' => 'Spécialiste du foie, du tube digestif, des voies biliaires et du pancréas'
            ],
            [
                'nom' => 'Médecine intensive-réanimation',
                'description' => 'Spécialiste de la prise en charge des patients en état critique.'
            ],
            [
                'nom' => 'Néphrologie',
                'description' => 'Spécialiste des reins.'
            ],
            [
                'nom' => 'Neurologie',
                'description' => 'Spécialiste du système nerveux.'
            ],
            [
                'nom' => 'Oncologie',
                'description' => 'Spécialiste du cancer.'
            ],
            [
                'nom' => 'Ophtalmologie',
                'description' => 'Spécialiste des yeux.'
            ],
            [
                'nom' => 'ORL (Oto-rhino-laryngologie)',
                'description' => 'Spécialiste des oreilles, du nez et de la gorge.'
            ],
            [
                'nom' => 'Pédiatrie',
                'description' => 'Spécialiste des enfants.'
            ],
            [
                'nom' => 'Pneumologie',
                'description' => 'Spécialiste des poumons et des voies respiratoires.'
            ],
            [
                'nom' => 'Psychiatrie',
                'description' => 'Spécialiste des troubles mentaux.'
            ],
            [
                'nom' => 'Radiologie',
                'description' => 'Spécialiste de l\'imagerie médicale (radiographies, scanners, IRM...).'
            ],
            [
                'nom' => 'Rhumatologie',
                'description' => 'Spécialiste des articulations, des os et des muscles.'
            ],
            [
                'nom' => 'Urologie',
                'description' => 'Spécialiste des voies urinaires et de l\'appareil reproducteur masculin.'
            ]

        ];
        $geographicAreas = [
            [
                'name' => "Zone 1",
                "countries" => [
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

                ]
            ],
            [
                'name' => "Zone 2",
                "countries" => [
                    // Afrique du Nord
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

                    // Afrique Australe
                    'bw', // Botswana
                    'ls', // Lesotho
                    'na', // Namibie
                    'za', // Afrique du Sud
                    'sz', // Eswatini
                ],
            ],
            [
                'name' => "Zone 3",
                "countries" => [
                    'ae',
                    'in',
                    'cn',
                    'tr',
                    // Afrique du Nord
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

                    // Afrique Australe
                    'bw', // Botswana
                    'ls', // Lesotho
                    'na', // Namibie
                    'za', // Afrique du Sud
                    'sz', // Eswatini
                ]
            ],
            [
                'name' => "Zone spécifiques afrique",
                "countries" => [
                    'ma',
                    'tn',
                    'za'
                ]
            ],
            [
                'name' => "Zone spécifiques internationale",
                "countries" => [
                    'ae',
                    'in',
                    'cn',
                    'tr',
                ]
            ],
        ];

  /*      foreach ($questionGroups as $title => $questionGroup) {
            $qg = QuestionGroup::create([
                "title" => $title,
                "question_type" => $questionGroup["type"],
                "page" => $questionGroup["page"],
            ]);
            foreach ($questionGroup["quiz"] as $question) {
                Question::query()->create([
                    ...$question,
                    "question_group_id" => $qg->id,
                ]);
            }
        }
        foreach ($specialites as $speciality) {
            Speciality::factory()->create([
                "name" => $speciality["nom"],
                "description" => $speciality["description"],
            ]);
        }*/
        foreach ($countries as $country) {
            /*Country::factory()->create([
                "id" => strtolower(trim($country["iso"])),
                "unicode_pair:" => "",
                ...$country
            ]);*/
         /*   Country::query()->where('id', strtolower(trim($country["iso"])))->update([
                "nationality" => $country["nationality"],
            ]);*/
        }
      /*  foreach ($geographicAreas as $geographicArea) {
            $_countries = $geographicArea["countries"];
            unset($geographicArea["countries"]);

            $geographicArea = GeographicArea::factory()->create($geographicArea);
            $geographicArea->countries()->attach($_countries, [
                "status" => "active",
            ]);

        }*/

        $insurancePolicies = [
            [
                "description" => "
                <ul>
  <li><b>Couverture Principale :</b>
    <ul>
      <li>Responsabilité Civile : Prise en charge des dommages causés à des tiers (plafonds plus élevés).</li>
      <li>Incendie, Explosion, Dégâts des Eaux : Protection de votre logement et de vos biens (valeur à neuf).</li>
      <li>Vol et Vandalisme : Indemnisation en cas de vol ou de dégradations (objets de valeur inclus).</li>
      <li>Catastrophes Naturelles et Technologiques : Couverture des événements exceptionnels déclarés officiellement.</li>
      <li>Bris de Glaces : Prise en charge des dommages aux fenêtres, miroirs, etc.</li>
      <li>Responsabilité Civile Vie Privée : Protection en cas de dommages causés par vous, votre famille ou vos animaux en dehors de votre domicile.</li>
    </ul>
  </li>
  <li><b>Assistance :</b>
    <ul>
      <li>Assistance Dépannage : En cas d'urgence à domicile (plomberie, électricité, serrurerie, chauffage).</li>
      <li>Relogement : Prise en charge des frais de relogement en cas de sinistre majeur.</li>
      <li>Aide Ménagère : Assistance pour le nettoyage de votre domicile après un sinistre.</li>
      <li>Garde d'enfants ou d'animaux : Prise en charge temporaire en cas d'hospitalisation.</li>
    </ul>
  </li>
  <li><b>Options Incluses :</b>
    <ul>
      <li>Protection Juridique : Assistance en cas de litige lié à votre habitation ou à votre vie privée.</li>
      <li>Garantie des Appareils Électroménagers : Prise en charge des réparations ou du remplacement en cas de panne.</li>
      <li>Garantie Objets de Valeur : Couverture spécifique pour les bijoux, œuvres d'art, etc.</li>
    </ul>
  </li>
  <li><b>Avantages :</b>
    <ul>
      <li>Une couverture très complète.</li>
      <li>Des plafonds d'indemnisation élevés.</li>
      <li>Des franchises réduites, voire inexistantes.</li>
      <li>De nombreuses options incluses.</li>
    </ul>
  </li>
  <li><b>Inconvénients :</b>
    <ul>
      <li>Un tarif plus élevé que la formule Silver.</li>
    </ul>
  </li>
</ul>
                ",
                "summary" => 'La Sérénité Totale: Une protection complète et étendue, pour une tranquillité d\'esprit absolue.',
                "name" => 'Premium',
                "img" => 'fake/product01.jpg',
            ],
            [
                "description" => "
                <ul>
  <li><b>Couverture Principale :</b>
    <ul>
      <li>Responsabilité Civile : Prise en charge des dommages causés à des tiers.</li>
      <li>Incendie, Explosion, Dégâts des Eaux : Protection de votre logement et de vos biens contre ces risques courants.</li>
      <li>Vol et Vandalisme : Indemnisation en cas de vol ou de dégradations.</li>
      <li>Catastrophes Naturelles et Technologiques : Couverture des événements exceptionnels déclarés officiellement.</li>
    </ul>
  </li>
  <li><b>Assistance :</b>
    <ul>
      <li>Assistance Dépannage : En cas d'urgence à domicile (plomberie, électricité, serrurerie).</li>
      <li>Garde d'enfants ou d'animaux : Prise en charge temporaire en cas d'hospitalisation.</li>
    </ul>
  </li>
  <li><b>Options :</b>
    <ul>
      <li>Protection Juridique : Assistance en cas de litige lié à votre habitation.</li>
    </ul>
  </li>
  <li><b>Avantages :</b>
    <ul>
      <li>Un tarif attractif.</li>
      <li>Une couverture des risques essentiels.</li>
      <li>Une assistance de base pour les urgences.</li>
    </ul>
  </li>
  <li><b>Inconvénients :</b>
    <ul>
      <li>Des garanties limitées par rapport à la formule supérieure.</li>
      <li>Des franchises potentiellement plus élevées.</li>
    </ul>
  </li>
</ul>
                ",
                "summary" => 'L\'Essentiel Protégé: Une couverture fiable pour les besoins essentiels, idéale pour un budget maîtrisé.',
                "name" => 'Silver',
                "img" => 'fake/product02.jpg',
            ]
        ];

       /* foreach ($insurancePolicies as $insurancePolicy) {
            $img = $insurancePolicy["img"];
            unset($insurancePolicy["img"]);
            $ip = InsurancePolicy::query()->create($insurancePolicy);
            $ip->miniature()->create([
                "path" => $img,
            ]);
        }*/

        /*foreach (["premium" => "warning", "silver" => "secondary"] as $type => $color) {

            $cardType = CardType::factory()->create([
                "id" => $type,
                "name" => $type,
                "color" => $color
            ]);
            //$cardType->questions()->attach(Question::factory(count: 4)->create());
        }*/


        // User::factory(10)->create();
       /* Customer::factory(count: 1)->create([
            "email" => "yves.koffi@devolution.africa",
        ]);
        User::factory(count: 1)->create([
            "email" => "admin@admin.com",
        ]);

        User::factory(count: 99)->create();
        Customer::factory(count: 110)->create();*/
        //InsurancePolicy::factory(count: 10)->create();
    }


}
