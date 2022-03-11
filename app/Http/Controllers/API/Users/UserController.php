<?php

namespace App\Http\Controllers\API\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Users\Manager\StoreRequest;
use App\Models\User;
use App\Http\Resources\Users\UserResource;
use App\Notifications\Users\RegisterNotification;

class UserController extends Controller
{
    public function store(StoreRequest $request){
        try {
            //$request['profile']='user';
            $request['profile']='manager';
            $request['password']=bcrypt($request->password);
            $request['accont']='active';
            $user = User::create($request->all());
            $user->notify(new RegisterNotification());
            return response()->json([
                'message'=>'create success',
                'data'=>new UserResource($user)
            ], 201);
        } catch (\Throwable $th) {
            \Log::critical('ERROR.- Create User: '.$th->getMessage().' | LINE: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }
}
