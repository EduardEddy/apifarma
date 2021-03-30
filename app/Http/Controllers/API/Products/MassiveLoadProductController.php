<?php

namespace App\Http\Controllers\API\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Products\MassiveLoadRequest;
use App\Imports\Products\ProductImport;

class MassiveLoadProductController extends Controller
{
    public function __invoke(MassiveLoadRequest $request)
    {
        try {
            \Excel::import(new ProductImport($request->store), $request->file);
            return response()->json([
                'message'=>'success',
                'data'=>null
            ], 201);
        } catch (\Throwable $th) {
            \Log::alert('Error.- invoke MassiveLoadProductController: '.$th->getMessage().' | Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }
}
