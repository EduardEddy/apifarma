<?php

namespace App\Http\Controllers\API\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use Auth;
use App\Http\Resources\Products\ProductResource;
use App\Http\Requests\Products\StoreRequest;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::where('store_id',Auth::user()->store->id)->get();
            return response()->json([
                'message'=>'success',
                'data'=>ProductResource::collection($products)
            ], 200);
        } catch (\Throwable $th) {
            \Log::alert('Error.- index ProductController: '.$th->getMessage().' | Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            if ($request->hasFile('file')) {
                $random = Str::random(30);
                $file = $request->file('file');
                $name = $random.'.'.$file->extension();
                $file->move(public_path('uploads/'), $name);
                $filepath='uploads/'.$name;
                $request['image']=$filepath;
            }
            $product = Product::create($request->all());
            return response()->json([
                'message'=>'success',
                'data'=>new ProductResource($product)
            ], 201);
        } catch (\Throwable $th) {
            \Log::alert('Error.- store ProductController: '.$th->getMessage().' | Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }

    public function update(StoreRequest $request, Product $product)
    {
        try {
            
            if ($request->hasFile('file')) {
                $random = Str::random(30);
                $file = $request->file('file');
                $name = $random.'.'.$file->extension();
                $file->move(public_path('uploads/'), $name);
                $filepath='uploads/'.$name;
                $request['image']=$filepath;
            }else{
                $request['image']=$product->image;
            }
            $request['user_updated_id'] = Auth::user()->id;
            $product->update($request->all());
            return response()->json([
                'message'=>'success',
                'data'=>new ProductResource($product)
            ], 200);
        } catch (\Throwable $th) {
            \Log::alert('Error.- update ProductController: '.$th->getMessage().' | Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }

    public function show(Product $product)
    {
        try {
            return response()->json([
                'message'=>'success',
                'data'=>new ProductResource($product)
            ], 200);
        } catch (\Throwable $th) {
            \Log::alert('Error.- show ProductController: '.$th->getMessage().' | Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }
}
