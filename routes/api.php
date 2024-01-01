<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\accounts;
use App\Http\Controllers\Api\status;
use App\Http\Controllers\Api\livelocation;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('signup',[accounts::class,'signup']);
Route::post('login',[accounts::class,'login']);
Route::get('logout',[accounts::class,'logout'])->middleware('auth:sanctum');
Route::post('update_status',status::class)->middleware('auth:sanctum');
Route::post('live_location',livelocation::class)->middleware('auth:sanctum');
