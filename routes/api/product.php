<?php

use App\Http\Controllers\API\Products\ProductController;
use App\Http\Controllers\API\Products\SearchProductController;
use App\Http\Controllers\API\Products\MassiveLoadProductController;

Route::group(['middleware' => ['auth:api']], function () {
    Route::prefix('products')->group(function () {
        Route::get('search',SearchProductController::class);
        Route::post('massive-loads',MassiveLoadProductController::class);

        Route::get('/',[ProductController::class,'index']);
        Route::post('/',[ProductController::class,'store']);
        Route::get('/{product}',[ProductController::class,'show']);
        Route::put('/{product}',[ProductController::class,'update']);

    });
});

