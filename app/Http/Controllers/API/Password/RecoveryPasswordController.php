<?php

namespace App\Http\Controllers\API\Password;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\ResetPassword;
use App\Http\Requests\Password\StoreRequest;
use App\Http\Requests\Password\UpdateRequest;

use App\Notifications\Password\ResetNotification;
use DB;

class RecoveryPasswordController extends Controller
{
    public function store(StoreRequest $request)
    {
        try {
            $user = ResetPassword::whereEmail($request->email)->first();
            if (!$user) {
                $user = ResetPassword::create(['email'=>$request->email]);
            }
            $user->notify(new ResetNotification());

            return response()->json([
                'message'=>'success',
                'data'=>null
            ], 201);
        } catch (\Throwable $th) {
            \Log::critical('ERROR.- store reset password: '.$th->getMessage().'  |  Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }

    public function show(ResetPassword $token)
    {
        try {
            return response()->json([
                'message'=>'sucess',
                'data'=>$token
            ], 200);
        } catch (\Throwable $th) {
            \Log::critical('ERROR.- show reset password: '.$th->getMessage().'  |  Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }

    public function update(ResetPassword $token, UpdateRequest $request)
    {
        try {
            $user = User::whereEmail($token->email)->first();
            $user->password = bcrypt($request->password);
            $user->save();
            DB::table('password_resets')->where('email', $token->email)->delete();
            return response()->json([
                'message'=>'success',
                'data'=>null
            ], 200);
        } catch (\Throwable $th) {
            \Log::critical('ERROR.- update reset password: '.$th->getMessage().'  |  Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }
}
