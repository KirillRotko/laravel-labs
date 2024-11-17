<?php

use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// public endpoints
Route::get('/hello', function () {
    return ':)';
});

// protected endpoints
Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('subscribers', SubscriberController::class);
    Route::apiResource('subscriptions', SubscriptionController::class);
});
