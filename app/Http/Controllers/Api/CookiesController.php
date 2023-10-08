<?php

namespace App\Http\Controllers\Api;

use App\Models\Cookie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class CookiesController extends Controller
{
    public function get_cookies(){
        $cookies = Cookie::pluck('value', 'id');
        return $cookies;
    }

    public function store(Request $request){
        $valdiator=Validator::make($request->all(),[
            'name'=>'required',
            'value'=>'required',
        ]);

        if ($valdiator->fails()) {
            $errors=$valdiator->errors();
            return response($errors);
        }
        $cookies=Cookie::create([
            'name'=>$request->name,
            'value'=>$request->value,
            //'user_id'=>$user->id,
        ]);
        return response()->json($cookies);
    }
}
