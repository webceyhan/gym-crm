<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('plans', 'PlanController');

Route::apiResource('members', 'MemberController');
Route::apiResource('members.attachments', 'AttachmentController')->shallow();
Route::apiResource('members.relatives', 'RelativeController')->shallow();
Route::apiResource('members.subscriptions', 'SubscriptionController')->shallow();

Route::apiResource('subscriptions.activities', 'ActivityController')->shallow();
Route::apiResource('subscriptions.payments', 'PaymentController')->shallow();
