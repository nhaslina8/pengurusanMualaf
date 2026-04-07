<?php

use App\Http\Controllers\Api\MuallafController;
use Illuminate\Support\Facades\Route;

Route::apiResource('muallafs', MuallafController::class)->names('api.muallafs');