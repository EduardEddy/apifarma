<?php

use App\Http\Controllers\API\Password\RecoveryPasswordController;

Route::group(['prefix' => 'reset-password'], function () {
    Route::post('/', [RecoveryPasswordController::class,'store']);
    Route::get('/{token:token}', [RecoveryPasswordController::class,'show']);
    Route::put('/{token:token}', [RecoveryPasswordController::class,'update']);
});
