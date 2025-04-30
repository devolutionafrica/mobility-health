<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GeographicAreaController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\InsurancePolicyController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionGroupController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

Route::middleware('auth')->group(function () {

    Route::get("/under/construction",function(){
        return view("pages.dashboard.under_construction");
    })->name("under.construction");

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/mobile/app', [DashboardController::class, 'app'])->name('mobile.app');

    Route::get('/client/{type}', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/client/{type}/{customer}', [CustomerController::class, 'show'])->name('customer.show');
    Route::get('/customer/subscription/{subscription}', [CustomerController::class, 'subscription'])->name('customer.subscription');

    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscription.index');
    Route::get('/subscriptions/{subscription}', [SubscriptionController::class, 'show'])->name('subscription.show');
    Route::get('/subscription/edit/{subscription}/{action}', [SubscriptionController::class, 'edit'])->name('subscription.edit');
    Route::put('/subscription/update/{subscription}/{action}', [SubscriptionController::class, 'update'])->name('subscription.update');

    Route::get('/insurance-policies', [InsurancePolicyController::class, 'index'])->name('insurance_policies.index');
    Route::get('/insurance-policy/create', [InsurancePolicyController::class, 'create'])->name('insurance_policies.create');
    Route::post('/insurance-policy/store', [InsurancePolicyController::class, 'store'])->name('insurance_policies.store');
    Route::get('/insurance-policy/show/{insurancePolicy}', [InsurancePolicyController::class, 'show'])->name('insurance_policies.show');
    Route::get('/insurance-policy/edit/{insurancePolicy}', [InsurancePolicyController::class, 'edit'])->name('insurance_policies.edit');
    Route::put('/insurance-policy/update/{insurancePolicy}', [InsurancePolicyController::class, 'update'])->name('insurance_policies.update');
    Route::get('/delete/insurance-policy/file/{insurancePolicy}', [InsurancePolicyController::class, 'deleteFileAttach'])->name('delete_file_attach.update');

    Route::get('/geographic-areas', [GeographicAreaController::class, 'index'])->name('geographic_area.index');
    Route::get('/geographic-area/create', [GeographicAreaController::class, 'create'])->name('geographic_area.create');
    Route::post('/geographic-area/store', [GeographicAreaController::class, 'store'])->name('geographic_area.store');
    Route::get('/geographic-area/edit/{geographicArea}', [GeographicAreaController::class, 'edit'])->name('geographic_area.edit');
    Route::put('/geographic-area/update/{geographicArea}', [GeographicAreaController::class, 'update'])->name('geographic_area.update');
    Route::delete('/geographic-area/delete/{geographicArea}', [GeographicAreaController::class, 'destroy'])->name('geographic_area.delete');

    Route::get('/insurance-policy/package/create/{insurancePolicy}', [PackageController::class, 'create'])->name('package.create');
    Route::post('/insurance-policy/package/store', [PackageController::class, 'store'])->name('package.store');
    Route::get('/insurance-policy/package/edit/{package}', [PackageController::class, 'edit'])->name('package.edit');
    Route::put('/insurance-policy/package/update/{package}', [PackageController::class, 'update'])->name('package.update');

    Route::get('/questions', [QuestionController::class, 'index'])->name('question.index');
    Route::get('/questions/create', [QuestionController::class, 'create'])->name('question.create');
    Route::post('/questions/store', [QuestionController::class, 'store'])->name('question.store');
    Route::get('/questions/edit/{question}', [QuestionController::class, 'edit'])->name('question.edit');
    Route::put('/questions/update/{question}', [QuestionController::class, 'update'])->name('question.update');
    Route::delete('/questions/delete/{question}', [QuestionController::class, 'destroy'])->name('question.delete');


    Route::get('/questions/group/create', [QuestionGroupController::class, 'create'])->name('questionGroup.create');
    Route::post('/questions/group/store', [QuestionGroupController::class, 'store'])->name('questionGroup.store');
    Route::get('/questions/group/edit/{questionGroup}', [QuestionGroupController::class, 'edit'])->name('questionGroup.edit');
    Route::put('/questions/group/update/{questionGroup}', [QuestionGroupController::class, 'update'])->name('questionGroup.update');


    Route::get('/users/{type}', [UserController::class, 'index'])->name('user.index');
    Route::get('/users/{type}/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/users/store/{type}', [UserController::class, 'store'])->name('user.store');
    Route::get('/users/{type}/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{type}/update/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/delete/{user}', [UserController::class, 'destroy'])->name('user.delete');

    Route::get('/user/password/edit/{user}', [UserController::class, 'editPassword'])->name('password.edit');
    Route::put('/user/password/update/{user}', [UserController::class, 'updatePassword'])->name('password.update');


    Route::post('/user/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});


require __DIR__ . '/auth.php';


Route::prefix("mh")->group(function () {
    Route::get("/image/{path}", [ImageController::class, "indexUrl"])
        ->where("path", ".*")
        ->name("image.indexUrl");
    Route::get("/image/binary/{path}", [ImageController::class, "indexBase64"])
        ->where("path", ".*")
        ->name("image.indexBase64");
});
