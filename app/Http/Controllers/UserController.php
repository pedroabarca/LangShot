<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    //
    public function signUp(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'user_name' => 'required|unique:users',
            'password' => 'required'
            ]);
        $user = new User([
           'name' => $request->input('name'),
            'email' => $request->input('email'),
            'user_name' => $request->input('user_name'),
            'password' =>bcrypt($request->input('password'))
        ]);
        $user->save();
        return response()->json([
            'Message' => 'User Created!'
        ],201);
    }

    public function signIn(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        try{
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json([
                    'error' => 'Invalid Data'
                ], 401);
            }
        }catch (JWTException $e){
            return response()->json([
                'error' => 'Could not create token'
            ], 500);
        }
        return response()->json([
            'token' => $token
        ], 200);
    }
}
