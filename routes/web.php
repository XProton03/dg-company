<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\CompanyController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [CompanyController::class, 'index'])->name('index');
Route::get('/portofolio', [CompanyController::class, 'portofolio'])->name('portofolio');
Route::get('/penjualan-perbaikan', [CompanyController::class, 'penjualan_perbaikan'])->name('penjualan_perbaikan');
Route::get('/layanan-berkala', [CompanyController::class, 'layanan_berkala'])->name('layanan_berkala');
Route::get('/layanan-borongan', [CompanyController::class, 'layanan_borongan'])->name('layanan_borongan');
Route::get('/maintenance-contract', [CompanyController::class, 'maintenance_contract'])->name('maintenance_contract');
Route::get('/profil-perusahaan', [CompanyController::class, 'profil_perusahaan'])->name('profil_perusahaan');
Route::get('/divisi-kerja', [CompanyController::class, 'divisi_kerja'])->name('divisi_kerja');
Route::get('/kontak', [CompanyController::class, 'kontak'])->name('kontak');
Route::get('/karir', [JobController::class, 'karir'])->name('jobapplications.karir');
Route::post('/jobs/apply/{id}', [JobController::class, 'apply'])->name('job.apply');
