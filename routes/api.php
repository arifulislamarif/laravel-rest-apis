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

Route::get('/user', function (Request $request) {
    return 1;
});

//  Authentication Apis
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login'])->name('api.login');
Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register'])->name('api.register');
Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/details', [App\Http\Controllers\Api\AuthController::class, 'details'])->name('api.details');
});

// Student Apis
Route::apiResource('student', App\Http\Controllers\Api\StudentController::class);

