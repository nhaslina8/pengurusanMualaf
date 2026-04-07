<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MuallafController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('muallafs.index');
})->name('dashboard');

Route::resource('muallafs', MuallafController::class);
