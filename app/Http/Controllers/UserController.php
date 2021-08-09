<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Auth;
class UserController extends Controller
{
    public function createUser(UserRequest $request)
    {
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);

        $token=$user->createToken('blogtoken')->plainTextToken;

        return response([
            'user'=>$user,
            'token'=>$token
        ],200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'=>'email|required',
            'password'=>'required'
        ]);

        $credentials=request(['email','password']);
        if (!Auth::attempt($credentials)) 
        {
            return response([
                'message'=>'invalid credentials'
            ],401);
        }
        $user=User::where('email',$request->email)->first();

        $token=$user->createToken('blogtoken')->plainTextToken;

        return response([
            'user'=>$user,
            'token'=>$token
        ],200);

    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response([
            'message'=>'logged out successfully'
        ],200);
    }
}
