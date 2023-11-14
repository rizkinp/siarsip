<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\kategoriController;
use App\Models\Kategori;

use App\Http\Controllers\MahasiswaController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/admin', function () {
    return view('admin');
});

//Arsip Controller

//INDEX ROUTE ARSIP CONTROLLER
Route::get('/arsip', [ArsipController::class, 'index'])->name('arsip.index');
//Route Create ArsipController
Route::get('/arsip/tambah', [ArsipController::class, 'create'])->name('arsip.create');
//Route Store Arsip Controller
Route::post('/arsip', [ArsipController::class, 'store'])->name('arsip.store');
// SHOW DETAILS
Route::get('/arsip/{id}', [ArsipController::class, 'show'])->name('arsip.show');
//UNDUH PDF
Route::get('/arsip/{id}/unduh', [ArsipController::class, 'unduhPdf'])->name('arsip.unduh');
// Proses Hapus Arsip Controller
Route::delete('/arsip/hapus/{id}', [ArsipController::class, 'delete'])->name('arsip.delete');

//Kategori Controllers
//Kategori route
Route::get('/kategori', [kategoriController::class, 'index'])->name('kategori.index');
//Route Create KategoriController
Route::get('/kategori/tambah', [kategoriController::class, 'create'])->name('kategori.create');
//Route Store Kategori Controller
Route::post('/kategori', [kategoriController::class, 'store'])->name('kategori.store');
// Show Detalis Kategori Controller
Route::get('/kategori/{id}', [kategoriController::class, 'show'])->name('kategori.show');
//Edit Kategori Controller
// Edit Kategori Controller
Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
// Update Kategori Controller
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
// Proses Hapus Kategori Controller
Route::delete('/kategori/hapus/{id}', [kategoriController::class, 'delete'])->name('kategori.delete');
//Proses Search Kategori Controller
Route::get('/kategori/search', [kategoriController::class, 'search'])->name('kategori.search');

//edit file pdf
Route::get('arsip/{id}/edit', [ArsipController::class, 'edit'])->name('arsip.edit');
Route::put('arsip/{id}', [ArsipController::class, 'update'])->name('arsip.update');
Route::get('/daftar-mahasiswa', [MahasiswaController::class, 'index'])->name('user.index');

// serach api
// web.php

// Route::get('/kategori/search', [KategoriController::class, 'search'])->name('kategori.search');



