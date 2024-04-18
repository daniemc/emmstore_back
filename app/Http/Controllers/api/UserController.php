<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use DateTime;

class UserController extends Controller
{
    public function show(Request $request)
    {
        $userId = $request->user()->id;
        $user = User::where('id', $userId)->first();
        return response()->json([
            'user' => $user,
        ]);
    }

    public function list(Request $request)
    {
        $users = User::all();
        return response()->json([
            'data' => $users,
        ], 200);
    }

    public function save(Request $request)
    {
        $requestUser = $request->user();

        $newUser = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'doc_type' => $request->doc_type,
            'doc' => $request->doc,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'created_by' => $requestUser->id,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        return response()->json([
            'status' => 'Usuario creado correctamente',
            'data' => $newUser,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $requestUser = $request->user();

        $updatedUser = User::where('id', $id)
            ->update([
                'name' => $request->name,
                'last_name' => $request->last_name,
                'username' => $request->username,
                'email' => $request->email,
                'doc_type' => $request->doc_type,
                'doc' => $request->doc,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'created_by' => $requestUser->id,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]);

        return response()->json([
            'status' => 'Usuario actualizado correctamente',
            'data' => $updatedUser,
        ], 200);
    }
    
    public function delete(Request $request, $id)
    {

        $deletedUser = User::where('id', $id)->delete();

        return response()->json([
            'status' => 'Usuario eliminado correctamente',
            'data' => $deletedUser,
        ], 200);
    }
}
