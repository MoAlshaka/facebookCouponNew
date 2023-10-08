<?php

namespace App\Http\Controllers\Facebook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageAccessToken;
use Illuminate\Support\Facades\Http;

class PageAccessController extends Controller
{
    public function page_access_token(){
        return view('facebook.pageaccess');

    }
    public function get_page_access_token(Request $request){
        $request->validate([
            "id"=>"required",
            "access_token"=>"required",
        ]);
        $id = $request->id;
        $access_token = $request->access_token;
        $user_id=auth()->user()->id;

        $url = "https://graph.facebook.com/$id/accounts?fields=name,access_token&access_token=$access_token";

        $response = Http::get($url);
      //  return $response;
        if ($response->successful()) {
            $data = $response->json()['data'];

            foreach ($data as $page) {
                $page_id = $page['id'];
                $name = $page['name'];
                $page_access_token = $page['access_token'];

                // Create a new PageAccess record
                PageAccessToken::create([
                    "account_id"=>$id,
                    "page_id"=>$page_id,
                    "page_name" => $name,
                    "page_access_token" => $page_access_token,
                    "user_id"=>$user_id,
                ]);
            }
            return response()->json(['message' => 'PageAccess records created successfully']);
        } else {
            return response()->json(['error' => 'API request failed'], $response->status());
        }
    }
}
