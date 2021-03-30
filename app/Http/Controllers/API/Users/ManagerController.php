<?php

namespace App\Http\Controllers\API\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Users\Manager\StoreRequest;
use App\Http\Requests\Users\Manager\UpdateRequest;
use App\Models\User;
use App\Http\Resources\Users\UserResource;
use App\Notifications\Users\RegisterNotification;
use Auth;

class ManagerController extends Controller
{
    public function index()
    {
        try {
            $users = User::where('profile','manager')->get();
            return response()->json([
                'message'=>'success',
                'data'=>UserResource::collection($users)
            ], 200);
        } catch (\Throwable $th) {
            \Log::critical('ERROR.- Index ManagerController: '.$th->getMessage().' | LINE: '.$th->getLine());
            return response()->json([
                'message'=>'internal error'
            ], 500);
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            $request['profile']='manager';
            $request['password']=bcrypt($request->password);
            $user = User::create($request->all());
            $user->notify(new RegisterNotification());
            return response()->json([
                'message'=>'create success',
                'data'=>new UserResource($user)
            ], 201);
        } catch (\Throwable $th) {
            \Log::critical('ERROR.- Create Manager: '.$th->getMessage().' | LINE: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }

    public function show(User $manager)
    {
        try {
            return response()->json([
                'message'=>'success',
                'data'=>new UserResource($manager)
            ], 200);
        } catch (\Throwable $th) {
            \Log::critical('ERROR.- Show Manager: '.$th->getMessage().' | LINE: '.$th->getLine());
            return response()->json([
                'message'=>'internal error'
            ], 500);
        }
    }

    public function update(UpdateRequest $request, User $manager)
    {
        try {
            $manager->update($request->all());
            return response()->json([
                'message'=>'success',
                'data'=>null
            ], 200);
        } catch (\Throwable $th) {
            \Log::critical('ERROR.- UPDATE Manager: '.$th->getMessage().' | LINE: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }

    public function delete(User $manager){
        try {
            $manager->delete();
            return response()->json([
                'message'=>'success',
                'data'=>null
            ], 200);
        } catch (\Throwable $th) {
            \Log::critical('ERROR.- DELETE Manager: '.$th->getMessage().' | LINE: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }

    public function active(){
        try {
            return response()->json([
                'message'=>'success',
                'data'=>new UserResource(Auth::user())
            ], 200);
        } catch (\Throwable $th) {
            \Log::critical('ERROR.- Active Manager: '.$th->getMessage().' | LINE: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }
}
