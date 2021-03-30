<?php

use App\Http\Controllers\API\Users\SellerController;

Route::group(['middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'store-sellers/{store}'], function () {
        Route::group(['prefix' => 'seller'], function () {
            Route::get('/', [SellerController::class,'index']);
            Route::post('/', [SellerController::class,'store']);
        });
        Route::get('active', [SellerController::class,'sellerActive']);
    });
});
