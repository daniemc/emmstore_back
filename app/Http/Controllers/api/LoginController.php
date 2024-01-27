<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use JWTFactory;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
        $credentials = $request->only('email', 'password');
        try {
            $user = User::where('email', $request->email)->first();
            if ($user->userData->status == 0) {
                return response()->json([
                    'success' => false,
                    'error' => 'invalid_credentials',
                ], 401);
            }
            JWTAuth::factory()->setTTL(7200);
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'error' => 'invalid_credentials'
                ], 401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'could_not_create_token'
            ], 500);
        }
        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => auth()->user(),
        ]);

    }
}
