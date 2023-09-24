<?php

namespace App\Http\Controllers\Facebook;

use App\Http\Controllers\Controller;
use App\Jobs\PostCoupon;
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
        shuffle($accessTokens);
        $count_accessTokens = count($accessTokens);
        $message = $request->message;
        $group_ids = explode("\r\n", $request->id);
        $image = $request->photo;
        $count = count($group_ids);

        // Initialize $j outside the loop
        $j = 0;
        $responses=[];
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
            if (isset($response['post_id'])) {
                $responses[] = $response['post_id'];
            }
            $j++;
        }
        return $responses;
        //return response()->json(['message' => 'Post created successfully']);
        // $accessTokens = PageAccessToken::pluck('page_access_token')->all();
        // shuffle($accessTokens);
        // $message = $request->message;
        // $groupIds = explode("\r\n", $request->id);
        // $image = $request->photo;
        // $responses = dispatch(new PostCoupon($groupIds, $message, $image, $accessTokens));
        // $allResponses = [];
        // foreach ($responses as $response) {
        //     $allResponses[] = $response->json(); // Assuming responses are JSON
        // }
        // return $allResponses;
    }
}
