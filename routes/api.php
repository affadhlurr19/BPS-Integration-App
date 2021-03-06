<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\PenilaianAngkaKreditController;
use App\Http\Controllers\KegiatanController;
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

//CUTI
Route::get('/cuti', [CutiController::class, 'index']);
Route::post('/cuti/create', [CutiController::class, 'store']);
Route::get('/cuti/show/{id_permintaan_cuti}', [CutiController::class, 'show']);
Route::put('/cuti/edit/{id_permintaan_cuti}', [CutiController::class, 'update']);
Route::delete('/cuti/delete/{id_permintaan_cuti}', [CutiController::class, 'destroy']);

//ABSEN
Route::get('/absen', [AbsensiController::class, 'index']);
Route::post('/absen/create', [AbsensiController::class, 'store']);
Route::get('/absen/show/{id_absensi}', [AbsensiController::class, 'show']);
Route::put('/absen/edit/{id_absensi}', [AbsensiController::class, 'update']);
Route::delete('/absen/delete/{id_absensi}', [AbsensiController::class, 'destroy']);

//PENILAIAN ANGKA KREDIT
Route::get('/penilaian-angka-kredit', [PenilaianAngkaKreditController::class, 'index']);
Route::post('/penilaian-angka-kredit/create', [PenilaianAngkaKreditController::class, 'store']);
Route::get('/penilaian-angka-kredit/show/{no_dupak}', [PenilaianAngkaKreditController::class, 'show']);
Route::put('/penilaian-angka-kredit/edit/{no_dupak}', [PenilaianAngkaKreditController::class, 'update']);
Route::delete('/penilaian-angka-kredit/delete/{no_dupak}', [PenilaianAngkaKreditController::class, 'destroy']);

//KEGIATAN
Route::get('/kegiatan', [KegiatanController::class, 'index']);
Route::post('/kegiatan/create', [KegiatanController::class, 'store']);
Route::get('/kegiatan/show/{id_kegiatan}', [KegiatanController::class, 'show']);
Route::put('/kegiatan/edit/{id_kegiatan}', [KegiatanController::class, 'update']);
Route::delete('/kegiatan/delete/{id_kegiatan}', [KegiatanController::class, 'destroy']);

//CAPAIAN KINERJA
Route::get('/capaian-kinerja', [CapaianKinerjaController::class, 'index']);
Route::post('/capaian-kinerja/create', [CapaianKinerjaController::class, 'store']);
Route::get('/capaian-kinerja/show/{id_ckp}', [CapaianKinerjaController::class, 'show']);
Route::put('/capaian-kinerja/update/{id_ckp}', [CapaianKinerjaController::class, 'update']);
Route::delete('/capaian-kinerja/destroy/{id_ckp}', [CapaianKinerjaController::class, 'destroy']);
