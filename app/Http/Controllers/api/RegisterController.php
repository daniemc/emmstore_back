<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => 'invalid_email',
            ]);
        }

        if (User::where('email', $request->email)->exists()) {
            return response()->json([
                'success' => false,
                'error' => 'email_exists',
            ]);
        }

        if (!Company::where('id', $request->company)->exists()) {
            return response()->json([
                'success' => false,
                'error' => 'invalid_company',
            ]);
        }

        $newUser = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        UserData::create([
            'user_id' => $newUser->id,
            'company_id' => $request->company,
            'nickname' => '',
            'display_name' => "{$request->name} {$request->last_name}",
            'avatar' => '',
            'role' => $request->role,
            'address' => '',
            'phone' => '',
            'status' => 1,
        ]);

        return response()->json([
            'success' => true,
        ]);

    }
}
