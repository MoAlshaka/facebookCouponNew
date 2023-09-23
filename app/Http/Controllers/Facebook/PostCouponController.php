<?php

namespace App\Http\Controllers\Facebook;

use App\Http\Controllers\Controller;
use App\Models\PageAccessToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostCouponController extends Controller
{
    public function index(){
        return view('facebook.post');
    }

    public function post(Request $request)
    {
        $accessTokens = PageAccessToken::pluck('page_access_token')->all();
        $count_accessTokens = count($accessTokens);
        $message = $request->message;
        $group_ids = explode("\r\n", $request->id);
        $image = $request->photo;
        $count = count($group_ids);

        // Initialize $j outside the loop
        $j = 0;

        for ($i = 0; $i < $count; $i++) {
            // Check if $j exceeds the count of access tokens and reset it
            if ($j >= $count_accessTokens) {
                $j = 0;
            }
            $access_token = $accessTokens[$j];
            $group_id = $group_ids[$i];

            $response = Http::post("https://graph.facebook.com/v18.0/$group_id/photos", [
                'message' => $message,
                'url' => $image,
                'access_token' => $access_token, // Use the correct access token
            ]);
            $j++;
        }

        return response()->json(['message' => 'Post created successfully']);

    }
}
