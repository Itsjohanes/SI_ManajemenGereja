<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengumumanApiController;
use App\Http\Controllers\PersembahanApiController;
use App\Http\Controllers\WartaApiController;
use App\Http\Controllers\RenunganApiController;
use App\Http\Controllers\VideoApiController;

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
Route::get('/pengumuman', [PengumumanApiController::class, 'getAll']);
Route::get('/persembahan', [PersembahanApiController::class, 'getAll']);
Route::get('/warta', [WartaApiController::class, 'getAll']);
Route::get('/renungan', [RenunganApiController::class, 'getAll']);
Route::get('/video', [VideoApiController::class, 'getAll']);
