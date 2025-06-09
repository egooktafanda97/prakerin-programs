<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataNilaiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\InstrukturController;
use App\Http\Controllers\PenempatanPrakerinController;
use App\Http\Controllers\LogbookPrakerinController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\WebsiteController;

Route::get('/', function () {
    return view('welcome');
});

/**
 * login
 */
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::resource('siswa', SiswaController::class);
Route::resource('guru', GuruController::class);
Route::resource('perusahaan', PerusahaanController::class);


Route::resource('instruktur', InstrukturController::class);
Route::resource('penempatan', PenempatanPrakerinController::class);
Route::resource('penempatan-prakerin', PenempatanPrakerinController::class);

Route::get('logbook-prakerin/validasi', [LogbookPrakerinController::class, 'validasiInstruktur'])->name('logbook-prakerin.validasi');
Route::get('logbook/{id?}', [LogbookPrakerinController::class, 'index'])->name('logbook-prakerin.show');
Route::resource('logbook-prakerin', LogbookPrakerinController::class);


//isvalidasi
Route::post('logbook-prakerin/isvalidasi/{id}', [LogbookPrakerinController::class, 'isValidasi'])->name('logbook-prakerin.isvalidasi');
/**
 * laporanKegiantan
 */
Route::get('laporan-kegiatan', [LogbookPrakerinController::class, 'laporanKegiatan'])->name('laporan-kegiatan.index');

/**
 * penilaian.create
 */
Route::get('penilaian/print', [PenilaianController::class, 'prints'])->name('penilaian.print');
Route::get('penilaian/create/{id}', [PenilaianController::class, 'create'])->name('penilaian.create');
Route::resource('penilaian', PenilaianController::class);


/**
 * website
 */
Route::get('/', [WebsiteController::class, 'index'])->name('website.index');

/**
 * DataNilaiController
 */
Route::prefix('nilai-siswa')->group(function () {
    Route::get('/', [DataNilaiController::class, 'index'])->name('nilai-siswa.index');
    Route::get('/create', [DataNilaiController::class, 'create'])->name('nilai-siswa.create');
    Route::post('/store', [DataNilaiController::class, 'store'])->name('nilai-siswa.store');
    Route::get('/{id}/edit', [DataNilaiController::class, 'edit'])->name('nilai-siswa.edit');
    Route::put('/update/{id}', [DataNilaiController::class, 'update'])->name('nilai-siswa.update');
    Route::delete('/destroy/{id}', [DataNilaiController::class, 'destroy'])->name('nilai-siswa.destroy');
});

/**
 * shoe nilai table siswa
 */
Route::get('/tabel-nilai-siswa', [WebsiteController::class, 'showTableNilai'])->name('tabel-nilai-siswa.show');
