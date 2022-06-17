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
// PEGAWAI AUTH //
Route::get('/pegawai/my-profile', [App\Http\Controllers\PegawaiController::class, 'showMyProfile'])->name('pegawai.show.profile')->middleware('pegawai_level');
Route::post('/pegawai/my-profile/update/{id}', [App\Http\Controllers\PegawaiController::class, 'updateMyProfile'])->name('pegawai.update.profile')->middleware('pegawai_level');
//DATA ABSENSI
Route::get('/pegawai/data-absensi', [App\Http\Controllers\PegawaiController::class, 'showDataAbsensi'])->name('pegawai.show.data.absensi')->middleware('pegawai_level');
Route::get('/pegawai/data-absensi/cari', [App\Http\Controllers\PegawaiController::class, 'cariDataAbsensi'])->name('pegawai.cari.data.absensi')->middleware('pegawai_level');
Route::post('/pegawai/data-absensi/post', [App\Http\Controllers\PegawaiController::class, 'postDataAbsensi'])->name('pegawai.post.data.absensi')->middleware('pegawai_level');
Route::post('/pegawai/data-absensi/update/{id}', [App\Http\Controllers\PegawaiController::class, 'updateDataAbsensi'])->name('pegawai.update.data.absensi')->middleware('pegawai_level');
Route::get('/pegawai/data-absensi/delete/{id}', [App\Http\Controllers\PegawaiController::class, 'deleteDataAbsensi'])->name('pegawai.delete.data.absensi')->middleware('pegawai_level');
//DATA CUTI
Route::get('/pegawai/data-cuti', [App\Http\Controllers\PegawaiController::class, 'showDataCuti'])->name('pegawai.show.data.cuti')->middleware('pegawai_level');
Route::get('/pegawai/data-cuti/cari', [App\Http\Controllers\PegawaiController::class, 'cariDataCuti'])->name('pegawai.cari.data.cuti')->middleware('pegawai_level');
Route::post('/pegawai/data-cuti/post', [App\Http\Controllers\PegawaiController::class, 'postDataCuti'])->name('pegawai.post.data.cuti')->middleware('pegawai_level');
Route::post('/pegawai/data-cuti/update/{id}', [App\Http\Controllers\PegawaiController::class, 'updateDataCuti'])->name('pegawai.update.data.cuti')->middleware('pegawai_level');
Route::get('/pegawai/data-cuti/delete/{id}', [App\Http\Controllers\PegawaiController::class, 'deleteDataCuti'])->name('pegawai.delete.data.cuti')->middleware('pegawai_level');
//DATA ANGKA KREDIT
Route::get('/pegawai/data-angka-kredit', [App\Http\Controllers\PegawaiController::class, 'showDataAngkaKredit'])->name('pegawai.show.data.angka.kredit')->middleware('pegawai_level');
Route::get('/pegawai/data-angka-kredit/cari', [App\Http\Controllers\PegawaiController::class, 'cariDataAngkaKredit'])->name('pegawai.cari.data.angka.kredit')->middleware('pegawai_level');
Route::post('/pegawai/data-angka-kredit/post', [App\Http\Controllers\PegawaiController::class, 'postDataAngkaKredit'])->name('pegawai.post.data.angka.kredit')->middleware('pegawai_level');
Route::post('/pegawai/data-angka-kredit/update/{id}', [App\Http\Controllers\PegawaiController::class, 'updateDataAngkaKredit'])->name('pegawai.update.data.angka.kredit')->middleware('pegawai_level');
Route::get('/pegawai/data-angka-kredit/delete/{id}', [App\Http\Controllers\PegawaiController::class, 'deleteDataAngkaKredit'])->name('pegawai.delete.data.angka.kredit')->middleware('pegawai_level');
//DATA KEGIATAN
Route::get('/pegawai/data-kegiatan', [App\Http\Controllers\PegawaiController::class, 'showDataKegiatan'])->name('pegawai.show.data.kegiatan')->middleware('pegawai_level');
Route::get('/pegawai/data-kegiatan/cari', [App\Http\Controllers\PegawaiController::class, 'cariDataKegiatan'])->name('pegawai.cari.data.kegiatan')->middleware('pegawai_level');
Route::post('/pegawai/data-kegiatan/post', [App\Http\Controllers\PegawaiController::class, 'postDataKegiatan'])->name('pegawai.post.data.kegiatan')->middleware('pegawai_level');
Route::post('/pegawai/data-kegiatan/update/{id}', [App\Http\Controllers\PegawaiController::class, 'updateDataKegiatan'])->name('pegawai.update.data.kegiatan')->middleware('pegawai_level');
Route::get('/pegawai/data-kegiatan/delete/{id}', [App\Http\Controllers\PegawaiController::class, 'deleteDataKegiatan'])->name('pegawai.delete.data.kegiatan')->middleware('pegawai_level');
//DATA CAPAIAN KINERJA
Route::get('/pegawai/data-capaian-kinerja', [App\Http\Controllers\PegawaiController::class, 'showDataCapaianKinerja'])->name('pegawai.show.data.capaian.kinerja')->middleware('pegawai_level');
Route::get('/pegawai/data-capaian-kinerja/cari', [App\Http\Controllers\PegawaiController::class, 'cariDataCapaianKinerja'])->name('pegawai.cari.data.capaian.kinerja')->middleware('pegawai_level');
Route::post('/pegawai/data-capaian-kinerja/post', [App\Http\Controllers\PegawaiController::class, 'postDataCapaianKinerja'])->name('pegawai.post.data.capaian.kinerja')->middleware('pegawai_level');
Route::post('/pegawai/data-capaian-kinerja/update/{id}', [App\Http\Controllers\PegawaiController::class, 'updateDataCapaianKinerja'])->name('pegawai.update.data.capaian.kinerja')->middleware('pegawai_level');
Route::get('/pegawai/data-capaian-kinerja/delete/{id}', [App\Http\Controllers\PegawaiController::class, 'deleteDataCapaianKinerja'])->name('pegawai.delete.data.kegiacapaian.kinerjatan')->middleware('pegawai_level');

// ADMIN AUTH //
Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard')->middleware('admin_level');
//DATA PEGAWAI
Route::get('/admin/data-pegawai', [App\Http\Controllers\AdminController::class, 'showDataPegawai'])->name('admin.show.data.pegawai')->middleware('admin_level');
Route::get('/admin/data-pegawai/cari', [App\Http\Controllers\AdminController::class, 'cariDataPegawai'])->name('admin.cari.data.pegawai')->middleware('admin_level');
Route::post('/admin/data-pegawai/update/{id}', [App\Http\Controllers\AdminController::class, 'updateDataPegawai'])->name('admin.update.data.pegawai')->middleware('admin_level');
Route::get('/admin/data-pegawai/delete/{id}', [App\Http\Controllers\AdminController::class, 'deleteDataPegawai'])->name('admin.delete.data.pegawai')->middleware('admin_level');
//DATA ABSENSI
Route::get('/admin/data-absensi', [App\Http\Controllers\AdminController::class, 'showDataAbsensi'])->name('admin.show.data.absensi')->middleware('admin_level');
Route::get('/admin/data-absensi/cari', [App\Http\Controllers\AdminController::class, 'cariDataAbsensi'])->name('admin.cari.data.absensi')->middleware('admin_level');
Route::post('/admin/data-absensi/update/{id}', [App\Http\Controllers\AdminController::class, 'updateDataAbsensi'])->name('admin.update.data.absensi')->middleware('admin_level');
Route::get('/admin/data-absensi/delete/{id}', [App\Http\Controllers\AdminController::class, 'deleteDataAbsensi'])->name('admin.delete.data.absensi')->middleware('admin_level');
//DATA CUTI
Route::get('/admin/data-cuti', [App\Http\Controllers\AdminController::class, 'showDataCuti'])->name('admin.show.data.cuti')->middleware('admin_level');
Route::get('/admin/data-cuti/cari', [App\Http\Controllers\AdminController::class, 'cariDataCuti'])->name('admin.cari.data.cuti')->middleware('admin_level');
Route::post('/admin/data-cuti/update/{id}', [App\Http\Controllers\AdminController::class, 'updateDataCuti'])->name('admin.update.data.cuti')->middleware('admin_level');
Route::get('/admin/data-cuti/delete/{id}', [App\Http\Controllers\AdminController::class, 'deleteDataCuti'])->name('admin.delete.data.cuti')->middleware('admin_level');
//DATA ANGKA KREDIT
Route::get('/admin/data-angka-kredit', [App\Http\Controllers\AdminController::class, 'showDataAngkaKredit'])->name('admin.show.data.angka.kredit')->middleware('admin_level');
Route::get('/admin/data-angka-kredit/cari', [App\Http\Controllers\AdminController::class, 'cariDataAngkaKredit'])->name('admin.cari.data.angka.kredit')->middleware('admin_level');
Route::post('/admin/data-angka-kredit/update/{id}', [App\Http\Controllers\AdminController::class, 'updateDataAngkaKredit'])->name('admin.update.data.angka.kredit')->middleware('admin_level');
Route::get('/admin/data-angka-kredit/delete/{id}', [App\Http\Controllers\AdminController::class, 'deleteDataAngkaKredit'])->name('admin.delete.data.angka.kredit')->middleware('admin_level');
//DATA KEGIATAN
Route::get('/admin/data-kegiatan', [App\Http\Controllers\AdminController::class, 'showDataKegiatan'])->name('admin.show.data.kegiatan')->middleware('admin_level');
Route::get('/admin/data-kegiatan/cari', [App\Http\Controllers\AdminController::class, 'cariDataKegiatan'])->name('admin.cari.data.kegiatan')->middleware('admin_level');
Route::post('/admin/data-kegiatan/update/{id}', [App\Http\Controllers\AdminController::class, 'updateDataKegiatan'])->name('admin.update.data.kegiatan')->middleware('admin_level');
Route::get('/admin/data-kegiatan/delete/{id}', [App\Http\Controllers\AdminController::class, 'deleteDataKegiatan'])->name('admin.delete.data.kegiatan')->middleware('admin_level');
//DATA CAPAIAN KINERJA
Route::get('/admin/data-capaian-kinerja', [App\Http\Controllers\AdminController::class, 'showDataCapaianKinerja'])->name('admin.show.data.capaian.kinerja')->middleware('admin_level');
Route::get('/admin/data-capaian-kinerja/cari', [App\Http\Controllers\AdminController::class, 'cariDataCapaianKinerja'])->name('admin.cari.data.capaian.kinerja')->middleware('admin_level');
Route::post('/admin/data-capaian-kinerja/update/{id}', [App\Http\Controllers\AdminController::class, 'updateDataCapaianKinerja'])->name('admin.update.data.capaian.kinerja')->middleware('admin_level');
Route::get('/admin/data-capaian-kinerja/delete/{id}', [App\Http\Controllers\AdminController::class, 'deleteDataCapaianKinerja'])->name('admin.delete.data.kegiacapaian.kinerjatan')->middleware('admin_level');