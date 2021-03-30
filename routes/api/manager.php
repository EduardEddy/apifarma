<?php
use App\Http\Controllers\API\Users\ManagerController;

Route::group(['prefix' => 'managers'], function () {
    Route::post('/', [ManagerController::class,'store']);
    Route::get('/', [ManagerController::class,'index']);
    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('/active', [ManagerController::class,'active']);
        Route::get('/{manager}', [ManagerController::class,'show']);
        Route::put('/{manager}', [ManagerController::class,'update']);
        Route::delete('/{manager}', [ManagerController::class,'delete']);
    });
});
