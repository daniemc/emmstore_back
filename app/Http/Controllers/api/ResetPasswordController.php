<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;
use DB;

class ResetPasswordController extends Controller
{

    public function getResetPasswordData(Request $request)
    {
        $user = User::with(['userData'])->where('email', $request->email)->first();
        if (!isset($user)) {
            return response()->json([
                'success' => false,
                'error' => 'error_invalid_username',
            ]);
        }
        $date_time = new DateTime();
        $token = base64_encode($request->email . $date_time->format('Y-m-d H:i:s'));
        DB::table('password_resets')
            ->insert(
                [
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => $date_time,
                ]
            );

        $client_url = env('APP_CLIENT_URL', 'http://192.168.0.5:3000/');

        $reset_link = $client_url . 'login/reset/' . $token;

        return response()->json([
            'success' => true,
            'token' => $token,
            'link' => $reset_link,
            'user' => $user,
        ]);
    }

    public function resetPassword(Request $request)
    {
        $token = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])->first();
        if (!isset($token)) {
            return response()->json([
                'success' => false,
                'error' => 'bad_key'
            ]);
        }

        User::where('email', $request->email)
            ->update([
                'password' => Hash::make($request->password),
            ]);

        DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
