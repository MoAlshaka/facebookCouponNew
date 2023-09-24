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
        $id = $request->id;
        $access_token = $request->access_token;

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
                    "user_id"=>$id,
                    "page_id"=>$page_id,
                    "page_name" => $name,
                    "page_access_token" => $page_access_token,
                ]);
            }

            // Optionally, you can return a success message or response here
            return response()->json(['message' => 'PageAccess records created successfully']);
        } else {
            // Handle the case where the API request was not successful
            return response()->json(['error' => 'API request failed'], $response->status());
        }
    }
}
