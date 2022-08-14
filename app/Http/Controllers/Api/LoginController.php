<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $users = User::where('email', $request->email)->first();
        if(!Hash::check($request->password,$users->password)){
            return 'this user not valid';
        }
        $user_status = ['admin','writer'];
        if(!in_array($users->status, $user_status)){
            return 'soory you can not login ';
        }
        $token = $users->createToken($users->name);
        return response()->json(['token'=> $token -> plainTextToken, 'user' => $users]);
    }

    public function logout(Request $request)
    {
        $user = User::where('id',$request->id)->first();
        $user->tokens()->delete();
        return $user;

    }
}
