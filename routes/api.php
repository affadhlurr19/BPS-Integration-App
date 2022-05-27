<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;

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

Route::get('/absen', [AbsensiController::class, 'index']);
Route::post('/absen/create', [AbsensiController::class, 'store']);
Route::get('/absen/show/{id_absensi}', [AbsensiController::class, 'show']);
Route::put('/absen/edit/{id_absensi}', [AbsensiController::class, 'update']);
Route::delete('/absen/delete/{id_absensi}', [AbsensiController::class, 'destroy']);