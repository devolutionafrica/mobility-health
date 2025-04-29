<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsurancePolicyRequest;
use App\Http\Requests\InsurancePolicyUpdateRequest;
use App\Models\Enums\Toast;
use App\Models\FileAttach;
use App\Models\InsurancePolicy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InsurancePolicyController extends Controller
{
    private $table = [
        "fields" => [
            "" => "auto",
            "titre" => "auto",
            "Action" => "150px",
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
            "action" => [
                "className" => 'text-right',
                "searchable" => false,
                "title" => "Action",
                "orderable" => false,
                "targets" => -1,
            ]
        ],
    ];

    public function index(Request $request)
    {

        $insurancePolicies = InsurancePolicy::query()
            ->with("miniature")
            ->latest()
            ->get();
            return view('pages.insurance-policies.index', [
                "insurancePolicies"=>$insurancePolicies
            ]);

    }


    public function create()
    {
        return view('pages.insurance-policies.create');
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            "description" => "nullable|string",
            "summary" => "nullable|string",
            "name" => "required|string",
            'img' => 'required|image|max:5120',
        ]);

        unset($data["img"]);
        $insurancePolicy = InsurancePolicy::query()->create($data);
        if ($request->hasFile('img')) {
            $insurancePolicy->miniature()->create([
                "path" => $request->img->store('insurance_policies/miniature', 'public')
            ]);
        }
        if ($request->hasFile('fileAttach')) {
            $fileAttachName = $request->input('fileAttachName');
            foreach ($request->file('fileAttach') as $index => $file) {
                $insurancePolicy->fileAttach()->create([
                    "path" => $file->store('insurance_policies/file-attach', 'public'),
                    "name" => $fileAttachName[$index]
                ]);
            }
        }

        session()->flash("toast",Toast::createSuccess->value);
        return $request->input('btn') === "continue" ? redirect()->back() : redirect()->route('insurance_policies.index');
    }

    public function show(Request $request,InsurancePolicy $insurancePolicy)
    {
        if ($request->ajax()) {

            $search = [];

            $totalData = $insurancePolicy->packages()->count();

            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');

            if (empty($request->input('search.value'))) {
                $packages = $insurancePolicy->packages()
                    ->offset($start)
                    ->limit($limit)
                    ->latest()
                    ->get();
            } else {
                $search = $request->input('search.value');

                $packages = $insurancePolicy->packages()
                    ->where(function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%{$search}%");
                    })
                    ->offset($start)
                    ->limit($limit)
                    ->latest()
                    ->get();

                $totalFiltered = $insurancePolicy->packages()
                    ->where(function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%{$search}%");
                    })
                    ->count();
            }

            $data = [];

            if (!empty($packages)) {
                // providing a dummy id instead of database ids
                $ids = $start;

                foreach ($packages as $package) {
                    $nestedData['type'] = status(__($package->type),$package->type == "mono" ? "info":"warning");
                    $nestedData['period'] = $package->validity_period_value.' '.strtolower(__($package->validity_period_type));
                    $nestedData['price'] = '<strong>'.number_format($package->price, 2, '.', ' ').'</strong>F CFA';

                    $nestedData["linkHTML"] = trActions([
                        trLink(title: 'Détails <i class="ti ti-arrow-right"></i>', url: route("package.edit", ["package" => $package->id]), type: "text", color: "primary")
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
            return view('pages.insurance-policies.show', [
                'insurancePolicy' => $insurancePolicy->load([
                    "fileAttach",
                    "miniature"
                ]),
                'table' => [
                    "fields" => [
                        "" => "auto",
                        "Type" => "auto",
                        "Période de validité" => "auto",
                        "Prix" => "auto",
                        "Action" => "150px",
                    ],
                    "columns" => [
                        "" => [
                            "className" => 'control',
                            "searchable" => false,
                            "orderable" => false,
                            "responsivePriority" => 2,
                            "targets" => 0,
                        ],

                        "type" => [
                            "responsivePriority" => 4,
                            "targets" => 1,
                        ],
                        "period" => [
                            "targets" => 2,
                        ],
                        "price" => [
                            "targets" => 2,
                        ],
                        "action" => [
                            "className" => 'text-right',
                            "searchable" => false,
                            "title" => "Action",
                            "orderable" => false,
                            "targets" => -1,
                        ]
                    ],
                ]
            ]);
        }
    }

    public function edit(InsurancePolicy $insurancePolicy)
    {
        return view('pages.insurance-policies.edit', [
            'insurancePolicy' => $insurancePolicy->load([
                "fileAttach",
                "miniature"
            ]),
        ]);
    }

    public function update(InsurancePolicyUpdateRequest $request, InsurancePolicy $insurancePolicy): RedirectResponse
    {
        $data = $request->validated();
        $insurancePolicy->update($data);
        if ($data["img"] != null) {
            $insurancePolicy->fileAttach()->create([
                "path" => $request->img->store('insurance_policies', 'public')
            ]);
        }
        session()->flash("toast",Toast::updateSuccess->value);
        return redirect()->back();
    }

    public function deleteFileAttach(InsurancePolicy $insurancePolicy): RedirectResponse
    {
        /**
         * @var $fileAttach FileAttach
         */
        $fileAttach = $insurancePolicy->fileAttach;
        @unlink(storage_path('app/public' . $fileAttach->path));
        $fileAttach->delete();
        return redirect()->back();
    }
}
