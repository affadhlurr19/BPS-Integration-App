<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('/');

Auth::routes();
Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/data-pegawai', [App\Http\Controllers\AdminController::class, 'showDataPegawai'])->name('admin.show.data.pegawai');
Route::get('/admin/data-absensi', [App\Http\Controllers\AdminController::class, 'showDataAbsensi'])->name('admin.show.data.absensi');
Route::get('/admin/data-cuti', [App\Http\Controllers\AdminController::class, 'showDataCuti'])->name('admin.show.data.cuti');
Route::get('/admin/data-angka-kredit', [App\Http\Controllers\AdminController::class, 'showDataAngkaKredit'])->name('admin.show.data.angka.kredit');
Route::get('/admin/data-kegiatan', [App\Http\Controllers\AdminController::class, 'showDataKegiatan'])->name('admin.show.data.kegiatan');
Route::get('/admin/data-capaian-kinerja', [App\Http\Controllers\AdminController::class, 'showDataCapaianKinerja'])->name('admin.show.data.capaian.kinerja');