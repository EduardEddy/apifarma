<?php

use App\Http\Controllers\API\Users\ActiveController;

Route::get('active/{token:verify_token}', ActiveController::class);
