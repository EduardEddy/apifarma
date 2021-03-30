<?php

namespace App\Http\Controllers\API\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ActiveController extends Controller
{
    public function __invoke(User $token)
    {
        try {
            $token->update([
                'account'=>'active',
                'email_verified_at'=>date('Y-m-d H:i:s'),
                'verify_token'=>null
            ]);
            return response()->json([
                'message'=>'success'
            ], 200);
        } catch (\Throwable $th) {
            \Log::critical('ERROR.- Active User: '.$th->getMessage().' | LINE: '.$th->getLine());
            return response()->json([
                'message'=>'internal error'
            ], 500);
        }
    }
}
