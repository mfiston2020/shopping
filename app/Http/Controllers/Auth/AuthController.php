<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login(Request $request){
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required',
        ]);

        $user   =   User::where('email',$request->email)->first();

        if (!$user) {
            return response()->json(['message'=>"User Not Found"],200);
        }
        return Hash::check($request->password,$user->password);

        if($user && Hash::check($request->password,$user->password))
        {
            // $user->createToken($request->email)->plainTextToken;
            $token = $user->createToken($request->email)->plainTextToken;
            return response()->json([
                'user'=>$user,
                'token'=>$token,
            ]);
        }
        else{
            return response()->json(['message'=>'invalid credentials'],200);
        }
    }
}
