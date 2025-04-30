<?php

namespace App\Http\Controllers;

use App\Models\Enums\Toast;
use App\Models\Package;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function create(string $insurancePolicy)
    {
        return view('pages.insurance-policies.package.create', [
            'insurancePolicyId' => $insurancePolicy
        ]);
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            "status" => "nullable|string",
            "insurance_policy_id" => "required|string",
            "geographic_area_id" => "required|string",
            "type" => "required|string",
            "price" => "required|integer",
            "validity_period_type" => "required|string",
            "validity_period_value" => "required|string",
        ]);

        //dd($data);
        $data['status'] = isset($data['status']) ? "active" : "inactive";
        Package::query()->create($data);
        session()->flash("toast",Toast::createSuccess->value);
        return $request->input('btn') === "continue" ? redirect()->back() : redirect()->route('insurance_policies.show', ["insurancePolicy" => $data["insurance_policy_id"]]);
    }

    public function edit(Package $package)
    {
        return view('pages.insurance-policies.package.edit', [
            'package' => $package->load('insurancePolicy'),
        ]);
    }

    public function update(Request $request, Package $package): RedirectResponse
    {
        $data = $request->validate([
            "status" => "nullable|string",
            "geographic_area_id" => "required|string",
            "type" => "required|string",
            "price" => "required|integer",
            "validity_period_type" => "required|string",
            "validity_period_value" => "required|string",
        ]);
        $data['status'] = isset($data['status']) ? "active" : "inactive";
        $package->update($data);
        session()->flash("toast",Toast::updateSuccess->value);
        return redirect()->back();
    }

}
