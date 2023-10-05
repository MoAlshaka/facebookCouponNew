<?php

namespace App\Http\Controllers\Pupeteer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ScrapController extends Controller
{
    public function scrap(){
        return view("pupeteer.scrap");
    }
    public function cookies(){
        return view("pupeteer.addCookies");
    }
    public function poster(){
        return view("pupeteer.poster");
    }
    public function reels(){
        return view("pupeteer.reels");
    }
    public function scrap_id(Request $request){
        $searchGroup=$request->searchGroup;
        $groupNumber=$request->groupNumber;
        $delay=$request->delay;
        $responses=Http::post("http://localhost:3000/api/v1/groupscrap",[
            'searchGroup'=>$searchGroup,
            'groupNumber'=> $groupNumber,
            'delay'=> $delay,
        ]);
        return view("pupeteer.scrap",['responses'=> $responses]);
    }
    public function add_cookies(Request $request){
        $emailsText = $request->input('emails');
        $lines = explode("\n", $emailsText);
        $emailsArray = [];
        foreach ($lines as $line) {
            $parts = explode(":", $line);
            if (count($parts) == 2) {
                $email = trim($parts[0]);
                $password = trim($parts[1]);
                $emailObject = [
                    'email' => $email,
                    'pass' => $password,
                ];
                $emailsArray[] = $emailObject;
            }
        }
        $delay=$request->delay;
        $responses=Http::post("http://localhost:3000/api/v1/addcookies",[
            'emails'=>$emailsArray,
            'delay'=> $delay,
        ]);
        return view("pupeteer.addCookies",['responses'=> $responses]);
    }
    public function group_Poster(Request $request){
        $message=$request->message;
        $delay=$request->delay;
        $Postdelay=$request->Postdelay;
        $idsText = $request->input('ids');
        $ids = explode("\n", $idsText);
        $responses=Http::post("http://localhost:3000/api/v1/session",[
            'messages'=> $message,
            'delay'=> $delay,
            'Postdelay'=>$Postdelay,
            'ids'=>$ids,
        ]);
        return view("pupeteer.poster",['responses'=> $responses]);
    }
    public function uplode_reels(Request $request){
        $message=$request->message;
        $delay=$request->delay;
        $Postdelay=$request->Postdelay;
        $responses=Http::post("http://localhost:3000/api/v1/reels",[
            'messages'=> $message,
            'delay'=> $delay,
            'Postdelay'=>$Postdelay,
        ]);
        return view("pupeteer.reels",['responses'=> $responses]);
    }
}
