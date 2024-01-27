<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Imports\UsersImport;
use App\Models\UserData;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function show(Request $request)
    {
        $userId = $request->user()->id;
        $user = User::with(['userData', 'portfolio'])
            ->where('id', $userId)->first();
        return response()->json([
            'user' => $user,
        ]);
    }

    public function get()
    {
        $users = User::with(['userData.company'])->get();

        return response()->json($users);
    }

    public function massUpload(Request $request)
    {
        Excel::import(new UsersImport, $request->file);

        $users = User::with(['userData.company'])->get();

        return response()->json($users);
    }

    public function avatar(Request $request)
    {
        $user_id = $request->user()->id;
        $avatar = $request->user()->userData->avatar;
        $avatarUrl = '';
        if (isset($avatar) && $avatar != '') {
            $avatarUrl = str_replace("/storage/", '/', $avatar);
            Storage::disk('public')->delete($avatarUrl);
        }
        $file = $request->file('file');
        $path = "user\avatar";
        $file_ext = $file->getClientOriginalExtension();
        $random = Str::random(5);
        $file_name = "{$random}_{$user_id}.{$file_ext}";
        $file_path = $file->storeAs($path, $file_name, 'public');
        $file_url = Storage::url($file_path);
        UserData::where('user_id', $user_id)
            ->update([
                'avatar' => $file_url,
            ]);
        
        return response()->json([
            'id' => $user_id,
            'file_url' => $file_url,
        ]);
    }

    public function deleteAvatar(Request $request)
    {
        $user_id = $request->user()->id;
        $avatar = $request->user()->userData->avatar;
        $avatarUrl = '';
        UserData::where('user_id', $user_id)
            ->update([
                'avatar' => '',
            ]);
        if (isset($avatar) && $avatar != '') {
            $avatarUrl = str_replace("/storage/", '/', $avatar);
            Storage::disk('public')->delete($avatarUrl);
        }
        return response()->json([
            'id' => $user_id,
        ]);
    }

    public function deleteUser(Request $request)
    {
        $user_id = $request->user_id;
        UserData::where('user_id', $user_id)
            ->update([
                'status' => 0,
            ]);
        $users = User::with(['userData.company'])->get();

        return response()->json($users);
    }
}
