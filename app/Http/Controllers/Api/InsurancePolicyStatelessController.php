<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InsurancePolicyResource;
use App\Http\Resources\SubscriptionResource;
use App\Models\Customer;
use App\Models\InsurancePolicy;
use App\Models\Package;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class InsurancePolicyStatelessController extends Controller
{

    public function insurancePolicies(): AnonymousResourceCollection
    {
        return InsurancePolicyResource::collection(InsurancePolicy::query()
            ->with("packages.geographicArea.countries")
            ->get());
    }

    public function subscribe(Request $request)
    {

        $data = $request->validate([
            "insurance_policy_ref" => "required|string",
            "destination_option" => "required|string",
            "zone_ref" => "required|string",
            "package_ref" => "required|string",
            "emit_date" => "required|string",
            "payment_method" => "required|string",
            "residence_id" => "required|string",
            "departure_code" => "required|string",
            "destination_code" => "required|string",
            "phone.code" => "nullable|string",
            "phone.number" => "required|string",
            "whatsapp.number" => "required|string",
            "whatsapp.code" => "nullable|string",
        ]);

        /**
         * @var $customer Customer
         *
         */
        $customer = $request->user();
        /**
         * @var $package Package
         */
        $package = Package::query()->find($data["package_ref"]);

        $subscription = $customer->subscriptions()->create([
            ...$data,
            "period" => [
                "type" => $package->validity_period_type,
                "value" => $package->validity_period_value
            ],
            "price" => $package->price,
        ]);
        /**
         * @var $subscription Subscription
         */
        $subscription = $subscription->refresh();
        try {
            Mail::to($customer->email)->sendNow(new \App\Mail\NewSubscribe(customer: $customer, insurancePolicy: $subscription->insurancePolicy));
        } catch (TransportExceptionInterface $exception) {
            //$exception->getMessage();

        }
        return SubscriptionResource::make($subscription);

    }
}
