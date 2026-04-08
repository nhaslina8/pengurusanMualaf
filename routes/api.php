<?php

use App\Http\Controllers\Api\MuallafController;
use App\Http\Controllers\Api\PendakwahController;
use Illuminate\Support\Facades\Route;

Route::apiResource('muallafs', MuallafController::class)->names('api.muallafs');
Route::apiResource('pendakwahs', PendakwahController::class)->names('api.pendakwahs');