<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Feed\FeedController;
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
Route::post('feed/store/', [FeedController::class, 'store'])->middleware('auth:sanctum');
Route::post('feed/like/{feed_id}', [FeedController::class, 'likePost']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test/', function(){
    return response([
        'message' => 'Api is Working'
    ], 200);
});

Route::post('register/', [AuthenticationController::class, 'register'])->name('register');
Route::post('login/', [AuthenticationController::class, 'login'])->name('login');