<?php

namespace App\Http\Controllers\API\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Users\Manager\StoreRequest;
use App\Models\User;
use App\Models\Store;
use App\Models\StoreSeller;
use App\Http\Resources\Users\UserResource;
use App\Http\Resources\Stores\StoreSellerResource;
use App\Classes\StoreSeller\StoreSellerClass;

class SellerController extends Controller
{
    public function index(Store $store)
    {
        try {
            $sellers = StoreSeller::where('store_id', $store->id)->get();
            return response()->json([
                'message'=>'success',
                'data'=>StoreSellerResource::collection($sellers)
            ], 200);
        } catch (\Throwable $th) {
            \Log::alert('ERROR.- SellerController Index: '.$th->getMessage().' Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }

    public function store(StoreRequest $request, Store $store)
    {
        try {
            $request['profile']='seller';
            $seller = User::create($request->all());
            StoreSellerClass::activeSeller($store, $seller);
            return response()->json([
                'message'=>'create success',
                'data'=>null
            ], 201);
        } catch (\Throwable $th) {
            \Log::alert('ERROR.- SellerController Store: '.$th->getMessage().' Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }

    public function show(User $seller)
    {
        try {
            return response()->json([
                'message'=>'success',
                'data'=>$seller
            ], 200);
        } catch (\Throwable $th) {
            \Log::alert('ERROR.- SellerController Show: '.$th->getMessage().' Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }

    public function update(StoreRequest $request, User $seller)
    {
        try {
            $seller->update($request->all());
            return response()->json([
                'message'=>'create success',
                'data'=>null
            ], 200);
        } catch (\Throwable $th) {
            \Log::alert('ERROR.- SellerController Store: '.$th->getMessage().' Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }

    public function delete(User $seller)
    {
        try {
            $seller->delete();
            return response()->json([
                'message'=>'success',
                'data'=>null
            ], 200);
        } catch (\Throwable $th) {
            \Log::alert('ERROR.- SellerController delete: '.$th->getMessage().' Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }

    public function sellerActive(Store $store)
    {
        try {
            $seller = StoreSeller::where(['store_id'=>$store->id,'status'=>'active'])->first();
            $user = User::find($seller->user_id);
            return response()->json([
                'message'=>'success',
                'data'=>new UserResource($user)
            ], 200);
        } catch (\Throwable $th) {
            \Log::alert('ERROR.- SellerController sellerActive: '.$th->getMessage().' Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }
}
