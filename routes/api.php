<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CapaianKinerjaController;

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

Route::get('/capaian-kinerja', [CapaianKinerjaController::class, 'index']);
Route::post('/capaian-kinerja/create', [CapaianKinerjaController::class, 'store']);
Route::get('/capaian-kinerja/show/{id_ckp}', [CapaianKinerjaController::class, 'show']);
Route::put('/capaian-kinerja/update/{id_ckp}', [CapaianKinerjaController::class, 'update']);
Route::delete('/capaian-kinerja/destroy/{id_ckp}', [CapaianKinerjaController::class, 'destroy']);
