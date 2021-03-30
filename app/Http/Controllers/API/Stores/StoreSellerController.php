<?php

namespace App\Http\Controllers\API\Stores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\StoreSeller;
use App\Http\Resources\Stores\StoreSellerResource;

class StoreSellerController extends Controller
{
    public function index(Request $request)
    {
        try {
            $store_sellers = $request->store ? StoreSeller::all() : StoreSeller::where('store_id', $request->store)->get();
            return response()->json([
                'message'=>'success',
                'data'=>StoreSellerResource::collection($store_sellers)
            ], 200);
        } catch (\Throwable $th) {
            \Log::alert('ERROR: Index StoreSeller: '.$th->getMessage().' | Line: '.$th->getLine());
            return response()->json([
                'message'=>'Internal Error'
            ], 500);
        }
    }

    public function listByUser(Request $request)
    {
        try {
            $store_sellers = !$request->list ? StoreSeller::find($request->id) : StoreSeller::where('user_id', $request->id)->get();
            return response()->json([
                'message'=>'success',
                'data'=>StoreSellerResource::collection($store_sellers)
            ], 200);
        } catch (\Throwable $th) {
            \Log::alert('ERROR: listByUser StoreSeller: '.$th->getMessage().' | Line: '.$th->getLine());
            return response()->json([
                'message'=>'Internal Error'
            ], 500);
        }
    }

    public function disabled(StoreSeller $sellerStore)
    {
        try {
            $sellerStore->update(['status'=>'inactive']);
            return response()->json([
                'message'=>'success',
                'data'=>null
            ], 200);
        } catch (\Throwable $th) {
            \Log::alert('ERROR: disabled StoreSeller: '.$th->getMessage().' | Line: '.$th->getLine());
            return response()->json([
                'message'=>'Internal Error'
            ], 500);
        }
    }
}
