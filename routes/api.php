<?php

use App\Http\Controllers\KegiatanController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/kegiatan', [KegiatanController::class, 'index']);
Route::post('/kegiatan/create', [KegiatanController::class, 'store']);
Route::get('/kegiatan/show/{id_kegiatan}', [KegiatanController::class, 'show']);
Route::put('/kegiatan/edit/{id_kegiatan}', [KegiatanController::class, 'update']);
Route::delete('/kegiatan/delete/{id_kegiatan}', [KegiatanController::class, 'destroy']);
