<?php

namespace App\Http\Controllers\API\Stores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\Stores\StoreResource;
use App\Models\Store;
use Auth;
use App\Http\Requests\Stores\StoreRequest;

class StoreController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message'=>'success',
                'data'=>StoreResource::collection(Store::all())
            ], 200);
        } catch (\Throwable $th) {
            \Log::alert('Error.- index Store: '.$th->getMessage().' | Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            $store = Store::create($request->all());
            return response()->json([
                'message'=>'success',
                'data'=>new StoreResource($store)
            ], 201);
        } catch (\Throwable $th) {
            \Log::alert('Error.- Store Store: '.$th->getMessage().' | Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }

    public function show(Store $store)
    {
        try {
            return response()->json([
                'message'=>'success',
                'data'=>new StoreResource($store)
            ], 200);
        } catch (\Throwable $th) {
            \Log::alert('Error.- Show Store: '.$th->getMessage().' | Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }

    public function update(Store $store, StoreRequest $request)
    {
        try {
            $store->update($request->all());
            return response()->json([
                'message'=>'success',
                'data'=>new StoreResource($store)
            ], 200);
        } catch (\Throwable $th) {
            \Log::alert('Error.- Update Store: '.$th->getMessage().' | Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error'
            ], 500);
        }
    }

    public function delete(Store $store)
    {
        try {
            $store->delete();
            return response()->json([
                'message'=>'success',
                'data'=>null
            ], 200);
        } catch (\Throwable $th) {
            \Log::alert('Error.- Update Store: '.$th->getMessage().' | Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }
}
