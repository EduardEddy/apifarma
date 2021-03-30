<?php

use App\Http\Controllers\API\Stores\StoreController;

Route::group(['middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'stores'], function () {
        Route::get('/', [StoreController::class,'index']);
        Route::post('/', [StoreController::class,'store']);
        Route::get('/{store}', [StoreController::class,'show']);
        Route::put('/{store}', [StoreController::class,'update']);
        Route::delete('/{store}', [StoreController::class,'delete']);
    });
});
