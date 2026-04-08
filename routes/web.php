<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MuallafController;
use App\Http\Controllers\PendakwahController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('muallafs.index');
})->name('dashboard');

Route::resource('muallafs', MuallafController::class);
Route::resource('pendakwahs', PendakwahController::class);
