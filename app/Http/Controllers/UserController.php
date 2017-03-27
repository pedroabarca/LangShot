<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = array();
        $all_users = User::all();
        foreach ($all_users as $user ){
            array_push($users, $user->user_name);
        }

        return response()->json($users,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        return response()->json(['message' => 'User Created!'],201);
    }

    /**
     * Display the specified resource to authenticate it.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signIn(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
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
    /**
     * Display the specified resource.
     *
     * @param User->user_name $user_name
     * @return \Illuminate\Http\Response
     */
    public function show($user_name)
    {

        $user = User::where('user_name', '=', $user_name)->first();
        if(!$user){
            return response()->json(['message' => 'User not Found'], 401);
        }
        $user_stories = [
            'stories' => $user->stories
        ];
        return response()->json([
            'id'=>$user->id,
            'name' => $user->name,
            'user_name' => $user->user_name,
            'email' => $user->email,
            $user_stories
        ],200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User->id $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'user_name' => 'required|unique:users',
            'password' => 'required'
        ]);
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not Found!'],404);
        }
        $user->user_name = $request->input('user_name');
        $user->name = $request->input('name');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return response()->json(['message'=>'User updated'],200);
    }


}
