<?php

use App\Http\Controllers\API\Invoices\InvoiceProductController;


Route::group(['middleware' => ['auth:api']], function () {
    Route::prefix('invoices-products')->group(function () {
        Route::get('/',[InvoiceProductController::class,'index']);
        Route::post('/',[InvoiceProductController::class,'store']);
    });
});
