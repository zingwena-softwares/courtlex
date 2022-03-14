<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    

    public function register(Request $request){
        //validate fields
        $attrs = $request->validate([
            'name'=>'required|string',
            'surname'=>'required|string',
            'email'=>'required|email|unique:users,email',
            'phone'=>'required|string',
            'law_firm'=>'required|string',
            'address'=>'required|string',
            'password'=>'required|min:6|confirmed'
        ]);

        //create user
        $user= User::create([
            'name'=>$attrs['name'],
            'surname'=>$attrs['surname'],
            'email'=>$attrs['email'],
            'phone'=>$attrs['phone'],
            'law_firm'=>$attrs['law_firm'],
            'address'=>$attrs['address'],
            'password'=>bcrypt($attrs['password']),
        ]);
         //return user and token in response
        return response([
                'user'=>$user,
                'token'=>$user->createToken('secret')->plainTextToken
            ],200);
    }
//login
    public function login(Request $request){
        //validate fields
        $attrs = $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6'
        ]);

        //attempt login
      
        if(!Auth::attempt($attrs)){
            return response([
                'message'=>"Invalid credentials."
            ], 403);
        }
         //return user and token in response
        return response([
                'user'=>auth()->user(),
                'token'=>auth()->user()->createToken('secret')->plainTextToken
            ], 200);
    }

    //logout
    public function  logout(){
        auth()->user()->tokens()->delete();
        return response([
            'message'=>'Logout success.'
        ], 200);
    }

    //get user details
    public function user(){
        return response([
            'user'=>auth()->user()
        ],200);
    }
}
