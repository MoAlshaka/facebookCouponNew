<?php

namespace App\Http\Controllers\Api;

use App\Models\Cookie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\Validator;


class CookiesController extends Controller
{
    public function get_cookies(){
        $cookies = Cookie::all();
        $formattedCookies = [];

        foreach ($cookies as $cookie) {
            $formattedCookie = [
                'collectionId' => 'qbbfpzddtydrp5p', // You can set this value as needed
                'collectionName' => 'cookies', // You can set this value as needed
                'created' => $cookie->created_at->toIso8601String(),
                'id' => $cookie->id,
                'name' => $cookie->name,
                'updated' => $cookie->updated_at->toIso8601String(),
                'value' => json_decode($cookie->value, true), // Assuming value is stored as JSON
            ];

            $formattedCookies[] = $formattedCookie;
        }

        return response()->json(['items' => $formattedCookies]);
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
