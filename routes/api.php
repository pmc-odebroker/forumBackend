<?php

use App\Http\Controllers\AuthAuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test/', function(){
    return response([
        'message' => 'Api is Working'
    ], 200);
});

Route::post('register/', [AuthAuthenticationController::class, 'register'])->name('register');
