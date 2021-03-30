<?php

use App\Http\Controllers\API\Stores\StoreSellerController;

Route::group(['middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'store-sellers'], function () {
        Route::get('/', [StoreSellerController::class, 'index']);
        Route::put('/{store}/disabled', [StoreSellerController::class, 'disabled']);
    });
});
