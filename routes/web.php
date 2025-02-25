<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\SaranController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;

// Frontpage routes
Route::get('/', [SaranController::class, 'index'])->name('saran.index');
Route::prefix('saran')->group(function () {
    Route::post('/', [SaranController::class, 'store'])->name('saran.store');
});
Route::prefix('divisi')->group(function () {
    Route::get('/ajax/sub-divisi/{divisiId?}', [DivisiController::class, 'getSubDivisi'])->name('divisi.ajax.sub_divisi');
});

// Dashboard routes
Route::group([
    'middleware' => 'auth',
    'prefix' => 'dashboard',
    'as' => 'dashboard.'
], function () {
    Route::get('/', 'HomeController@index')->name('index');
    Route::middleware('is-admin')->group(function () {
        Route::resource('users', 'UserController');
        Route::resource('saran', 'LaporanController');
        Route::get('saran/divisi/{divisiId}', [LaporanController::class, 'show'])->name('saran.show');
    });
    Route::get('saran', [LaporanController::class, 'index'])->name('saran.index');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('profile', [ProfileController::class, 'store'])->name('profile.store');
    Route::resource('divisi', 'DivisiController');
});

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    
   if($exitCode) return redirect()->route('saran.index');
});

Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:clear');
    
   if($exitCode) return redirect()->route('saran.index');
});

Route::get('/key-generate', function() {
    $exitCode = Artisan::call('key:generate');
    
   if($exitCode) return redirect()->route('saran.index');
});

Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    
   if($exitCode) return redirect()->route('saran.index');
});


// Auth routes
Auth::routes([
    'register' => false,
    'verify' => false,
    'reset' => false
]);
