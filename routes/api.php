<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenilaianAngkaKreditController;

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

Route::get('/penilaian-angka-kredit', [PenilaianAngkaKreditController::class, 'index']);
Route::post('/penilaian-angka-kredit/create', [PenilaianAngkaKreditController::class, 'store']);
Route::get('/penilaian-angka-kredit/show/{no_dupak}', [PenilaianAngkaKreditController::class, 'show']);
Route::put('/penilaian-angka-kredit/edit/{no_dupak}', [PenilaianAngkaKreditController::class, 'update']);
Route::delete('/penilaian-angka-kredit/delete/{no_dupak}', [PenilaianAngkaKreditController::class, 'destroy']);