<?php

use App\Http\Controllers\Api\AuthenticatedStatelessController;
use App\Http\Controllers\Api\DataStatelessController;
use App\Http\Controllers\Api\HealthRecordController;
use App\Http\Controllers\Api\InsurancePolicyStatelessController;
use App\Http\Controllers\Api\RegisteredCustomerController;
use App\Http\Controllers\Api\UploadCustomerFileController;
use App\Models\InsurancePolicy;
use App\Models\QuestionGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get("/", [RegisteredCustomerController::class, 'medicalIssues']);

/*Route::get("/", function () {

    return  \App\Http\Resources\InsurancePolicyResource::collection(InsurancePolicy::query()->with("packages.geographicArea.countries")->get());

    return \App\Http\Resources\QuestionGroupResource::collection(QuestionGroup::query()->has('questions')->get());

    $customer = \App\Models\Customer::query()->first();
    $customer->otp = "655445";
    $customer->email = "yves.koffi@devolution.africa";
    $customer->save();
    $customer->refresh();
    Mail::to($customer->email)->send(new \App\Mail\SendOTP($customer));
});*/

Route::get('/countries',[DataStatelessController::class, 'countries'])
    ->middleware('cache.headers:public;max_age=3600;etag');


Route::post("/generate/otp", [AuthenticatedStatelessController::class, 'generateOtp']);
Route::post("/login/with/otp", [AuthenticatedStatelessController::class, 'store']);
Route::post("/customer/register", [RegisteredCustomerController::class, 'store']);
Route::get("/subscribe/medical-issues", [HealthRecordController::class, 'medicalIssues']);

Route::middleware(['auth:sanctum'])->prefix("auth")->group(function () {
    Route::get('/current/customer',[DataStatelessController::class, 'customerWithData']);
    Route::get("/subscribe/medical-issues", [HealthRecordController::class, 'medicalIssues']);
    Route::get("/register/find/questions", [HealthRecordController::class, 'questions']);
    Route::post("/store/health-record", [HealthRecordController::class, 'store']);
    Route::get("/insurance-policies", [InsurancePolicyStatelessController::class, 'insurancePolicies'])
        ->middleware('cache.headers:public;max_age=3600;etag');
    Route::post("/insurance-policy/subscribe", [InsurancePolicyStatelessController::class, 'subscribe']);
    Route::post("/upload/document", [UploadCustomerFileController::class, 'uploadDocument']);
    Route::post("/upload/update/profile", [UploadCustomerFileController::class, 'uploadProfilePicture']);

});




