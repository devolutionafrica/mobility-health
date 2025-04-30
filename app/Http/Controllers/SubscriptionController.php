<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Enums\Toast;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $query = Subscription::query()->latest();

            $totalData = $query->count();

            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');

            if (empty($request->input('search.value'))) {
                $subscriptions = $query
                    ->with(["customer", "package", "insurancePolicy", "residence", "departure", "destination", "geographicArea"])
                    ->offset($start)
                    ->limit($limit)
                    ->latest()
                    ->get();
            } else {
                $search = $request->input('search.value');

                $subscriptions = $query
                    ->with(["customer", "package", "insurancePolicy", "residence", "departure", "destination", "geographicArea"])
                    ->where('id', 'LIKE', "%{$search}%")
                    /*   ->orWhere('firstname', 'LIKE', "%{$search}%")
                       ->orWhere('lastname', 'LIKE', "%{$search}%")
                       ->orWhere('email', 'LIKE', "%{$search}%")*/
                    ->offset($start)
                    ->limit($limit)
                    ->latest()
                    ->get();

                $totalFiltered = $query
                    ->where('id', 'LIKE', "%{$search}%")
                    /*->orWhere('firstname', 'LIKE', "%{$search}%")
                    ->orWhere('lastname', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")*/
                    ->count();
            }

            $data = [];

            foreach ($subscriptions as $subscription) {
                $nestedData['ref'] = '<span class="text-success me-2">#' . Str::upper(Str::limit($subscription->id, 8, "")) . '</span>';
                $nestedData['name'] = '<span class="badge bg-label-secondary me-2">' . $subscription->insurancePolicy->name . '</span>';
                $nestedData['start'] = $subscription->status != "validate" ? "-" : $subscription->date_start->format('d/m/Y');
                $nestedData['end'] = $subscription->status != "validate" ? "-" : $subscription->date_end->format('d/m/Y');
                $nestedData['price'] = number_format($subscription->price, 0, "", " ") . "F CFA";
                $nestedData['status'] = status(match ($subscription->status) {
                    "validate" => Carbon::now()->lte($subscription->date_end) ? "En cours" : "Expirer",
                    "pending" => "En attente",
                    "cancel" => "Annuler",
                    "reject" => "Rejeter"
                }, type: match ($subscription->status) {
                    "validate" => Carbon::now()->lte($subscription->date_end) ? "success" : "danger",
                    "pending" => "secondary",
                    "cancel" => "warning",
                    "reject" => "danger"
                });

                $nestedData["linkHTML"] = trActions([
                    trLink(title: 'consulter <i class="ti ti-arrow-right"></i>', url: route("subscription.show", ["subscription" => $subscription->id]), type: "text", color: "primary")
                ]);

                $data[] = $nestedData;
            }

            if ($data) {
                return response()->json([
                    'draw' => intval($request->input('draw')),
                    'recordsTotal' => intval($totalData),
                    'recordsFiltered' => intval($totalFiltered),
                    'code' => 200,
                    'data' => $data,
                ]);
            } else {
                return response()->json([
                    'message' => 'Internal Server Error',
                    'code' => 500,
                    'data' => [],
                ]);
            }
        } else {
            return view('pages.subscriptions.index', [
                'table' => [
                    "fields" => [
                        "" => "auto",
                        " " => "64px",
                        "Formule" => "auto",
                        "Debut" => "auto",
                        "Fin" => "auto",
                        "Montant" => "auto",
                        "Statut" => "auto",
                        "Actions" => "160px",
                    ],
                    "columns" => [
                        "" => [
                            "className" => 'control',
                            "searchable" => false,
                            "orderable" => false,
                            "responsivePriority" => 2,
                            "targets" => 0,
                        ],

                        "ref" => [
                            "responsivePriority" => 4,
                            "targets" => 1,
                        ],
                        "name" => [
                            "responsivePriority" => 4,
                            "targets" => 2,
                        ],
                        "start" => [
                            "targets" => 3,
                        ],
                        "end" => [
                            "responsivePriority" => 4,
                            "targets" => 4,
                        ],
                        "price" => [
                            "targets" => 5,
                        ],
                        "status" => [
                            "targets" => 6,
                        ],
                        "action" => [
                            "className" => 'text-right',
                            "searchable" => false,
                            "title" => "Action",
                            "orderable" => false,
                            "targets" => -1,
                        ]
                    ]
                ]
            ]);
        }
    }

    public function show(Request $request, Subscription $subscription):View
    {
        return view('pages.subscriptions.subscribe', [
            'subscription' => $subscription->load(["customer", "package", "insurancePolicy", "residence", "departure", "destination", "geographicArea"]),
        ]);
    }


    public function edit(Request $request, Subscription $subscription, string $action):View
    {
        return view('pages.subscriptions.edit', [
            'subscription' => $subscription->load(["customer", "package", "insurancePolicy"]),
            "action" => $action,
        ]);

    }

    public function update(Request $request, Subscription $subscription, string $action)
    {

        $rules = [];
        if ($action == "validate") {
            $rules["date_start"] = "required|date";
        } else {
            $rules["status_message"] = "required|string";
        }
        $data = $request->validate($rules);

        if ($action == "validate") {

            $dateStart = Carbon::parse($data["date_start"]);
            $dateEnd = match ($subscription->period["type"]) {
                "year" => Carbon::parse($data["date_start"])->addYears(value: intval($subscription->period["value"])),
                "day" => Carbon::parse($data["date_start"])->addDays(value: intval($subscription->period["value"])),
                default => Carbon::parse($data["date_start"])->addMonths(value: intval($subscription->period["value"]))
            };

            $subscription->update([
                "status" => $action,
                "date_start" => $dateStart,
                "date_end" => $dateEnd,
            ]);

            /**
             * @var $customer Customer
             */
            $customer = $subscription->customer;
            if ($customer->insuredCard == null) {
                $customer->insuredCard()->create([
                    "insured_number" => self::generateNumber(16),
                    "card_number" => self::genererNumeroCarte(),
                    "issue_date" => Carbon::now(),
                    "expiration_date" => Carbon::now()->addMonths(12 * 10),
                    "status" => "active",
                ]);
            }

        } else {
            $subscription->update([
                "status" => $action,
                "status_message" => $data["status_message"],
            ]);
        }
        session()->flash("toast", Toast::createSuccess->value);
        return redirect()->route("subscription.show", ["subscription" => $subscription->id]);
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
