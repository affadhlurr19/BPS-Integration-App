<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CutiController;

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

Route::get('/cuti', [CutiController::class, 'index']);
Route::post('/cuti/create', [CutiController::class, 'store']);
Route::get('/cuti/show/{id_permintaan_cuti}', [CutiController::class, 'show']);
Route::put('/cuti/edit/{id_permintaan_cuti}', [CutiController::class, 'update']);
Route::delete('/cuti/delete/{id_permintaan_cuti}', [CutiController::class, 'destroy']);
