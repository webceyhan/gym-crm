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

// supplement routes
Route::get('relatives', 'RelativeController@index');
Route::get('attachments', 'AttachmentController@index');
Route::get('subscriptions', 'SubscriptionController@index');
Route::get('activities', 'ActivityController@index');
Route::get('payments', 'PaymentController@index');

// resource routes
Route::apiResource('plans', 'PlanController');
Route::apiResource('members', 'MemberController');
Route::apiResource('members.relatives', 'RelativeController')->shallow();
Route::apiResource('members.attachments', 'AttachmentController')->shallow();
Route::apiResource('members.subscriptions', 'SubscriptionController')->shallow();
Route::apiResource('subscriptions.activities', 'ActivityController')->shallow();
Route::apiResource('subscriptions.payments', 'PaymentController')->shallow();
