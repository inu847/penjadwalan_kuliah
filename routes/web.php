<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\HariController;
use App\Http\Controllers\JamController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\PengampuController;
use App\Http\Controllers\PenjadwalanController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\WaktuKhususController;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Matkul;
use App\Models\Ruang;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        $jumlah_dosen = Dosen::count();
        $jumlah_matkul = Matkul::count();
        $jumlah_ruang = Ruang::count();
        $jumlah_kelas = Kelas::count();

        return view('dashboard.index', compact('jumlah_dosen', 'jumlah_matkul', 'jumlah_ruang', 'jumlah_kelas'));
    });
    
    Route::resource('dosen', DosenController::class);
    Route::resource('hari', HariController::class);
    Route::resource('jam', JamController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('matkul', MatkulController::class);
    Route::resource('pengampu', PengampuController::class);

    Route::resource('penjadwalan', PenjadwalanController::class);
    // GENERATE PENJADWALAN
    Route::post('penjadwalan/generate', [PenjadwalanController::class, 'generateJadwal'])->name('penjadwalan.generate');
    Route::post('penjadwalan/clear-all', [PenjadwalanController::class, 'clearAll'])->name('penjadwalan.clearAll');

    Route::resource('ruang', RuangController::class);
    Route::resource('waktu_khusus', WaktuKhususController::class);
    Route::get('getDosenChecked', [WaktuKhususController::class, 'getDosenChecked'])->name('waktu_khusus.getDosenChecked');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
