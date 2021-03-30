<?php

namespace App\Http\Controllers\API\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\product;

class SearchProductController extends Controller
{
    public function __invoke(Request $request)
    {
        try {

            $products=Product::searchProduct($request->q, $request->country,$request->lat, $request->lng);

            return response()->json([
                'message'=>'success',
                'data'=>$products
            ], 200);
        } catch (\Throwable $th) {
            \Log::alert('Error.- invoke SearchProductController: '.$th->getMessage().' | Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }
}
