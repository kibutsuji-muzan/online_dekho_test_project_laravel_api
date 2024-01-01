<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class accounts extends Controller
{
    //
    function signup(Request $request)
    {
        $rule = [
            'username' => 'required|max:20|min:5',
            'password' => 'required|max:30|min:8',
            'first_name' => 'required|max:20|min:5',
            'last_name' => 'required|max:20|min:5',
        ];
        $validator = Validator::make($request->all(), $rule);
        if ($validator->fails()) {
            return response()->json($validator->errors(),400);
        }
        $uuid = (String) Str::uuid();
        $user = User::where('username', $request['username'])->first();
        if ($user != null) {
            return response()->json(['response' => 'user with this username already exsist'], 400);
        }
        $user = User::create([
            'member_id' => $uuid,
            'username' => $request['username'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'password' => $request['password'],
        ]);
        return response()->json($user,200);
    }

    function login(Request $request)
    {
        $rule = [
            'username' => 'required|max:20|min:5',
            'password' => 'required|max:30|min:8'
        ];
        $validator = Validator::make($request->all(), $rule);
        if ($validator->fails()) {
            return response()->json($validator->errors(),400);
        }
        $user = User::where('username', $request['username'])->first();
        if (Auth::attempt(['username' => $request['username'], 'password' => $request['password']])) {
            $token = $request->user()->createToken($request->username);
            return ['token' => $token->plainTextToken, 'user' => $user];
        }
        return response()->json(['response' => 'username or password incorrect'], 404);
    }

    function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'response' => 'You have been logged out from this device'
        ], 200);
    }
}
