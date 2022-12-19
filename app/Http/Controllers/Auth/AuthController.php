<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    function login(Request $request){
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required',
        ]);

        $user = User::where('email',$request->first());
        if (!$user){
            return response()->json(['message'=>"User Not Found"],200);
        }
        if($user && Hash::check($request->password,$user->password)){
            $token = $user->createToken($request->email)->plainTextToken;
            return response()->json([
                'user'=>$user,
                'token'=>$token,
            ]);
        }else{
            return response()->json(['message'=>'invalid credentials'],200);
        }
    }
}
