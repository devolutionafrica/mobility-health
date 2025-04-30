<?php

namespace App\Http\Controllers;

use App\Models\Enums\Toast;
use App\Models\GeographicArea;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GeographicAreaController extends Controller
{
    private $table = [
        "fields" => [
            "" => "auto",
            "Zone" => "300px",
            "Pays" => "auto",
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
            "zone" => [
                "responsivePriority" => 4,
                "targets" => 1,
            ],
            "countries" => [
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
    ];

    public function index(Request $request)
    {

        if ($request->ajax()) {

            $search = [];

            $totalData = GeographicArea::query()->count();

            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');

            if (empty($request->input('search.value'))) {
                $geographicAreas = GeographicArea::query()
                    ->with('countries')
                    ->offset($start)
                    ->limit($limit)
                    ->latest()
                    ->get();
            } else {
                $search = $request->input('search.value');

                $geographicAreas = GeographicArea::query()
                    ->with('countries')
                    ->where(function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%{$search}%");
                    })
                    ->offset($start)
                    ->limit($limit)
                    ->latest()
                    ->get();

                $totalFiltered = GeographicArea::query()
                    ->with('countries')
                    ->where(function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%{$search}%");
                    })
                    ->count();
            }

            $data = [];

            if (!empty($geographicAreas)) {
                // providing a dummy id instead of database ids
                $ids = $start;

                foreach ($geographicAreas as $geographicArea) {
                    $nestedData['zone'] = ucfirst($geographicArea->name);
                    $nestedData['countries'] = "<div class='row '><div class='col-12 line-clamp-2'>" . implode(', ', $geographicArea->countries->pluck('name')->toArray()) . "</div></div>";


                    $nestedData["linkHTML"] = trActions([
                        trLink(title: 'Détails <i class="ti ti-arrow-right"></i>', url: route("geographic_area.edit", ["geographicArea" => $geographicArea->id]), type: "text", color: "primary")
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

            //session()->flash("toast",Toast::deleteDanger->value);
            return view('pages.geographic-area.index', [
                "table" => $this->table,
                'totalUser' => 14,
                'verified' => 2,
                'notVerified' => 0,
                'userDuplicates' => 0,
            ]);
        }

    }


    public function create()
    {
        return view('pages.geographic-area.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string",
            "countries" => "required|array",
        ]);

        $ga = GeographicArea::query()->create([
            "name" => $data["name"],
        ]);
        $ga->countries()->sync($data["countries"]);
        session()->flash("toast", Toast::createSuccess->value);
        return $request->input('btn') === "continue" ? redirect()->back() : redirect()->route('geographic_area.index');
    }

    public function edit(GeographicArea $geographicArea)
    {
        return view('pages.geographic-area.edit', [
            'geographicArea' => $geographicArea,
        ]);
    }

    public function update(Request $request, GeographicArea $geographicArea): RedirectResponse
    {
        $data = $request->validate([
            "name" => "required|string",
            "countries" => "required|array",
        ]);

        $geographicArea->update([
            "name" => $data["name"],
        ]);
        $geographicArea->countries()->sync($data["countries"]);
        session()->flash("toast", Toast::updateSuccess->value);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param GeographicArea $geographicArea
     * @return RedirectResponse
     */
    public function destroy( GeographicArea $geographicArea)
    {
        $geographicArea->delete();
        session()->flash("toast",Toast::deleteSuccess->value);
        return redirect()->route("geographic_area.index");
    }

}
