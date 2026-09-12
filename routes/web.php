<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengunjungController;

Route::get('/', function () {
    return view('before-login.dashboard-guest');
});


Route::post('pengunjungs', [PengunjungController::class, 'store'])->name('pengunjungs.store');
Route::get('/kepuasan/{id}', [PengunjungController::class, 'kepuasanForm'])->name('pengunjungs.kepuasan');
Route::post('/kepuasan', [PengunjungController::class, 'storeKepuasan'])->name('pengunjungs.storeKepuasan');
Route::get('/kepuasan-index', [PengunjungController::class, 'indexReview'])->name('kepuasan.index');



// Show the login form
Route::get('/login', [LoginController::class, 'index'])->name('login');

// Handle login
Route::post('/login', [LoginController::class, 'login']);

// Handle logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('pengunjungs', [PengunjungController::class, 'index'])->name('pengunjungs.index');
    Route::get('pengunjungs/{id}/edit', [PengunjungController::class, 'edit'])->name('pengunjungs.edit');
    Route::put('pengunjungs/{id}', [PengunjungController::class, 'update'])->name('pengunjungs.update');
    Route::delete('pengunjungs/{id}', [PengunjungController::class, 'destroy'])->name('pengunjungs.destroy');
    Route::get('/pengunjungs/search', [PengunjungController::class, 'search'])->name('pengunjungs.search');
    Route::get('pengunjungs/export-excel', [PengunjungController::class, 'exportExcel'])->name('pengunjungs.exportExcel');
    Route::get('pengunjungs/export-excel-review', [PengunjungController::class, 'exportExcelReview'])->name('pengunjungs.exportExcelReview');


    Route::get('pengunjungs/review', [PengunjungController::class, 'review'])->name('pengunjungs.review');


    // Use UserController@index for the /users route
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/detail/{id}', [UserController::class, 'detail'])->name('users.detail');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/search', [UserController::class, 'search'])->name('users.search');

});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');