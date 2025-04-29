<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Http\Resources\CustomerResource;
use App\Models\Country;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class DataStatelessController extends Controller
{
    public function countries(): AnonymousResourceCollection
    {
        return CountryResource::collection(Country::all());
    }

    public function customerWithData(Request $request): CustomerResource
    {
        $customer=$request->user();
        return CustomerResource::make($customer);
    }
}
