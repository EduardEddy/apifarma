<?php

use App\Http\Controllers\API\Invoices\InvoiceProductController;
use App\Http\Controllers\API\Invoices\InvoicesController;


Route::group(['middleware' => ['auth:api']], function () {
    Route::prefix('invoices-products')->group(function () {
        Route::get('/',[InvoiceProductController::class,'index']);
        Route::post('/',[InvoiceProductController::class,'store']);
    });
    
    Route::prefix('invoices')->group(function () {
        Route::get('/{invoice}',[InvoicesController::class,'show']);
        Route::put('/{invoice}/change-deliverys',[InvoicesController::class,'updateDelivery']);
        Route::put('/{invoice}/change-status',[InvoicesController::class,'updateStatus']);
    });
});
