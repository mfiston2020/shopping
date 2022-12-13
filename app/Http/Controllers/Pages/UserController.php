<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function showUsers(){
        $users  =   User::all();
        $count_users    =   count($users);
        return response()->json(['number_of_users'=>$count_users,'list_of_users'=>$users],200);
    }
    public function showUser($id)
    {
        $userInfo   =   User::find($id);
        return response()->json(['user_info'=>$userInfo],200);
    }

    function saveUser(Request $request){
        $this->validate($request,[
            'country_name'=>'required',
            'full_name'=>'required|max:100',
            'email'=>'required|email|unique:users,email',
            'gender'=>'required',
            'date_of_birth'=>'required|date',
        ]);

        try {
            $User   =   User::create([
                'country_code'=>$request->country_name,
                'full_name'=>$request->full_name,
                'email'=>$request->email,
                'gender'=>$request->gender,
                'date_of_birth'=>$request->date_of_birth,
            ]);

            return response()->json(['message'=>'user successfully created!','user_info'=>$User],200);
        } catch (\Throwable $th) {
            return response()->json(['message'=>'Something went wrong! '.$th],500);
        }
    }

    function updateUser(Request $request,$id){
        $this->validate($request,[
            'country_name'=>'required',
            'full_name'=>'required|max:100',
            'email'=>'required|email|unique:users,email',
            'gender'=>'required',
            'date_of_birth'=>'required|date',
        ]);

        try {
            $user   =   User::findOrFail($id);
            $user->country_code =  $request->country_name;
            $user->full_name    =   $request->full_name;
            $user->email        =   $request->email;
            $user->gender       =   $request->gender;
            $user->date_of_birth=   $request->date_of_birth;
            $user->save();

            return response()->json(['message'=>'user successfully updated!','user_info'=>$user],200);
        } catch (\Throwable $th) {
            return response()->json(['message'=>'Something went wrong! '],500);
        }
    }

    function deleteUser($id)
    {
        try {
            $userInfo   =   User::findOrFail($id)->delete();
            // $userInfo;
            return response()->json(['message'=>"User deleted successfully!"],200);
        } catch (\Throwable $th) {
            return response()->json(['message'=>"Something Went Wrong!! ".$th],500);
        }
    }
}
