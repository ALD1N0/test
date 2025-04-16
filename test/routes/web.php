<?php
use App\Http\Controllers\KelasControll;
use App\Http\Controllers\MahasiswaControll;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginControll;

Route::get('/', function () {
    return redirect()->route('mahasiswa.index');
});



Route::get('/kelas', [KelasControll::class, 'index'])->name('kelas.index');
Route::get('/kelas/create', [KelasControll::class, 'create'])->name('kelas.create');
Route::post('/kelas', [KelasControll::class, 'store'])->name('kelas.store');
Route::get('/kelas/{kela}/edit', [KelasControll::class, 'edit'])->name('kelas.edit');
Route::put('/kelas/{kela}', [KelasControll::class, 'update'])->name('kelas.update');
Route::delete('/kelas/{kela}', [KelasControll::class, 'destroy'])->name('kelas.destroy');

Route::get('/mahasiswa', [MahasiswaControll::class, 'index'])->name('mahasiswa.index');
Route::get('/mahasiswa/create', [MahasiswaControll::class, 'create'])->name('mahasiswa.create');
Route::post('/mahasiswa', [MahasiswaControll::class, 'store'])->name('mahasiswa.store');
// Route::get('/mahasiswa/{mahasiswa}/edit', [MahasiswaControll::class, 'edit'])->name('mahasiswa.edit');
Route::get('/mahasiswa/{id}/edit', [MahasiswaControll::class, 'nobin'])->name('mahasiswa.edit');
Route::put('/mahasiswa/{mahasiswa}', [MahasiswaControll::class, 'update'])->name('mahasiswa.update');
Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaControll::class, 'destroy'])->name('mahasiswa.destroy');


// Route::resource('kelas', controller: KelasControll::class);
// Route::resource('mahasiswa', MahasiswaControll::class);



Route::get('/register', [loginControll::class, 'showRegister'])->name('register');
Route::post('/register', [loginControll::class, 'register']);

// Route::get('/login', [loginControll::class, 'showLogin'])->name('login');
// Route::post('/login', [loginControll::class, 'login']);

Route::get('/dashboard', [loginControll::class, 'dashboard'])->name('dashboard');
Route::post('/logout', [loginControll::class, 'logout'])->name('logout');
