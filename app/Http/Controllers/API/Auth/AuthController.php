<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use Auth;
use Laravel\Passport\TokenRepository;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            if (Auth::attempt(array_merge($request->only('email', 'password'), ['account'=>'active']))) {
                $user = Auth::user();
                $user->token =  $user->createToken('web-front')->accessToken;
                $user->store;
                return response()->json([
                    'message'=>'success',
                    'data' => $user
                ], 200);
            }

            return response()->json([
                'message'=>'invalid credentials',
                'data'=>null
            ], 401);
        } catch (\Throwable $th) {
            \Log::critical('ERROR.- Login: '.$th->getMessage().' | Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            //$result = $tokenRepository->revokeAccessToken(Auth::user()->token);
            if (Auth::user()->AauthAcessToken()->delete()) {
                $response = response()->json([
                    'message'=>'User logout successfully.',
                    'data'=>null
                ], 200);
            } else {
                $response = response()->json([
                    'message'=>'Something is wrong.','data'=>null
                ], 400);
            }
            return $response;
        } catch (\Throwable $th) {
            \Log::critical('ERROR.- Logout: '.$th->getMessage().' | Line: '.$th->getLine());
            return response()->json([
                'message'=>'internal error',
                'data'=>null
            ], 500);
        }
    }
}
