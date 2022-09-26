<?php

use App\Http\Controllers\AuthApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\BukuController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('buku',[BukuController::class, 'index']);
Route::post('addbuku',[BukuController::class, 'store']);
Route::get('buku/{id}',[BukuController::class, 'show']);
Route::post('update/{id}',[BukuController::class, 'update']);
Route::delete('delete/{id}',[BukuController::class, 'destroy']);

// route api auth
Route::post('register', [AuthApiController::class, 'register']);
Route::post('login', [AuthApiController::class, 'login']);
Route::post('logout', [AuthApiController::class, 'logout']);
