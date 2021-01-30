<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(UserLoginRequest $request){
        if (Auth::attempt([
            'email' => $request->email,
             'password' => $request->password]
        )) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;

            return response()->json(['success' => $success, 'message' => 'Login Succeeded', 'user' => $user], 200);
        }else{
            return response()->json(['message' => 'Unauthorized Access'], 203);
        }
    }

    public function register(UserRegisterRequest $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // $responseArray = [];
        // $responseArray['token'] = $user->createToken('MyApp')->access_token;
        // $responseArray['name'] = $user->name;

        if(!$user){
            return response()->json(['message' => 'Registration Failed'], 500);
        }

        return response()->json(['message' => 'Registration Succeeded'], 200);
    }

    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user]);
    }
}

