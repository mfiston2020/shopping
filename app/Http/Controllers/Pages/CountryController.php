<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    function showCountries(){
        $countries  =   Country::all();
        $count_countries      =   count($countries);
        return response()->json(['number_of_countries'=>$count_countries,'countries'=>$countries],200);
    }

    function saveCountry(Request $request){
        $this->validate($request,[
            'name'=>'required|unique:countries,name',
            'continent_name'=>'required|min:4',
        ]);
        
        Country::create([
            'name'=>$request->name,
            'continent_name'=>$request->continent_name,
        ]);

        return response()->json(['message'=>'country created successfully!'],200);
    }
    function getCountry(){
        
    }
}
