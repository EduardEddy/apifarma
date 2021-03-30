<?php

use App\Http\Controllers\API\Auth\AuthController;

Route::post('/login', [AuthController::class,'login']);
Route::post('/logout', [AuthController::class,'logout']);
