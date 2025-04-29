<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomerController extends Controller
{

    public function index(Request $request, string $type)
    {

        //dd(strtolower(str_replace(" ",";",str_replace("U+","&#x","U+1F1E8 U+1F1EC")).';'));
        if ($request->ajax()) {

            $query = $type == "prospects" ? Customer::query()
                ->doesntHave('subscriptions') : Customer::query()
                ->with(['subscriptions' => ["insurancePolicy", "geographicArea"]])
                ->has('subscriptions');
            $totalData = $query->count();

            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');

            if (empty($request->input('search.value'))) {
                $customers = $query
                    ->with("avatar")
                    ->offset($start)
                    ->limit($limit)
                    ->latest()
                    ->get();
            } else {
                $search = $request->input('search.value');

                $customers = $query
                    ->with("avatar")
                    ->where('id', 'LIKE', "%{$search}%")
                    ->orWhere('firstname', 'LIKE', "%{$search}%")
                    ->orWhere('lastname', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->latest()
                    ->get();

                $totalFiltered = $query
                    ->where('id', 'LIKE', "%{$search}%")
                    ->orWhere('firstname', 'LIKE', "%{$search}%")
                    ->orWhere('lastname', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->count();
            }

            $data = [];

            if (!empty($customers)) {

                /**
                 * @var $customer Customer
                 */
                foreach ($customers as $customer) {
                    $imgPath = $customer->avatar == null ? null : urlGen(src: route("image.indexUrl", ["path" => $customer->avatar?->path]), width: 64, height: 64, fit: "contain");

                    $phone = is_array($customer->phone_number) ? '<strong>(' . ($customer->phone_number["code"] ?? "+225") . ')</strong> ' . $customer->phone_number["number"] : $customer->phone_number;
                    if ($type == "prospects") {
                        $nestedData['name'] = profile(fullName: ucfirst($customer->name), path: $imgPath, subTitle: $phone);
                        $nestedData['country'] = '<div style="display: flex;align-items: center"><img alt="' . $customer->nationality_id . '" style="width: 20px;margin-right: 8px;" width="20" src="https://flagcdn.com/w320/' . $customer->nationality_id . '.png"/><span>' . $customer->country->name . '</span></div>';
                        $nestedData['email'] = $customer->email;
                    } else {
                        /**
                         * @var $subscriptions Collection<Subscription>
                         */
                        $subscriptions = $customer->subscriptions;
                        $subscribeWaiting = $subscriptions->where('status', "pending");
                        $subscribeActive = $subscriptions
                            ->where('status', "validate")
                            ->where('date_end', '>=', Carbon::today())
                            ->sortBy('date_end');
                        $nestedData['name'] = profile(fullName: $customer->name, path: $imgPath, subTitle: $phone);

                        $nestedData['subscribeWaiting'] = status($subscribeWaiting->count() > 0 ? $subscribeWaiting->count() : "-", type: $subscribeWaiting->count() > 0 ? "warning" : "secondary");
                        if ($subscribeActive->isNotEmpty()) {
                            $sub = $subscribeActive->first();
                            $nestedData['subscribe'] = '
                         <div style="display: flex;align-items: center">
                          <span class="badge bg-label-secondary me-2 fw-bold">' . $sub->insurancePolicy->name . '</span>
                           <div class="">
                              <div>' . $sub->geographicArea->name . '</div>
                              <div class="small text-success">' . $sub->date_start->format("d/m/Y") . ' - ' . $sub->date_end->format("d/m/Y") . '</div>
                            </div>
                          </div>
                        ';
                        } else {
                            $nestedData['subscribe'] = 'Indéfinie';
                        }


                    }
                    $nestedData["linkHTML"] = trActions([
                        trLink(title: 'consulter <i class="ti ti-arrow-right"></i>', url: route('customer.show', ['type' => $type, 'customer' => $customer->id]), type: "text", color: "primary")
                    ]);

                    $data[] = $nestedData;
                }
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
            return view('pages.customers.index', [
                'type' => $type,
                'table' => $type == "prospects" ? [
                    "fields" => [
                        "" => "auto",
                        "Nom et Prénoms" => "auto",
                        "Email" => "auto",
                        "Pays" => "auto",
                        "Action" => "160px",
                    ],
                    "columns" => [
                        "" => [
                            "className" => 'control',
                            "searchable" => false,
                            "orderable" => false,
                            "responsivePriority" => 2,
                            "targets" => 0,
                        ],

                        "name" => [
                            "responsivePriority" => 4,
                            "targets" => 1,
                        ],
                        "email" => [
                            "className" => 'text-center',
                            "targets" => 2,
                        ],
                        "country" => [
                            "targets" => 3,
                        ],
                        "action" => [
                            "className" => 'text-right',
                            "searchable" => false,
                            "title" => "Action",
                            "orderable" => false,
                            "targets" => -1,
                        ]
                    ]
                ] :
                    [
                        "fields" => [
                            "" => "auto",
                            "Nom et prénoms" => "300px",
                            "Souscription active" => "auto",
                            "En attente" => "120px",
                            "Action" => "160px",
                        ],
                        "columns" => [
                            "" => [
                                "className" => 'control',
                                "searchable" => false,
                                "orderable" => false,
                                "responsivePriority" => 2,
                                "targets" => 0,
                            ],

                            "name" => [
                                "responsivePriority" => 4,
                                "targets" => 1,
                            ],
                            "subscribe" => [
                                "targets" => 2,
                            ],
                            "subscribeWaiting" => [
                                "targets" => 2,
                            ],
                            "action" => [
                                "className" => 'text-right',
                                "searchable" => false,
                                "title" => "Action",
                                "orderable" => false,
                                "targets" => -1,
                            ]
                        ]
                    ],
            ]);
        }
    }

    public function show(Request $request, string $type, Customer $customer)
    {

        if ($request->ajax()) {


            $subscriptions = $customer->subscriptions()->get();
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
                    "reject" => "rejeter"
                }, type: match ($subscription->status) {
                    "validate" => Carbon::now()->lte($subscription->date_end) ? "success" : "danger",
                    "pending" => "secondary",
                    "cancel" => "warning",
                    "reject" => "danger"
                });

                $nestedData["linkHTML"] = trActions([
                    trLink(title: 'consulter <i class="ti ti-arrow-right"></i>', url: route("customer.subscription", ["subscription" => $subscription->id]), type: "text", color: "primary")
                ]);

                $data[] = $nestedData;
            }


            return response()->json([
                'draw' => intval($request->input('draw')),
                'recordsTotal' => intval(count($data)),
                'recordsFiltered' => intval(0),
                'code' => 200,
                'data' => $data,
            ]);
        }

        return view('pages.customers.show', [
            'type' => $type,
            'customer' => $customer,
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

    public function subscription(Request $request, Subscription $subscription)
    {
        return view('pages.customers.subscribe', [
            'subscription' => $subscription->load(["customer", "package", "insurancePolicy", "residence", "departure", "destination", "geographicArea"]),
        ]);
    }
}
