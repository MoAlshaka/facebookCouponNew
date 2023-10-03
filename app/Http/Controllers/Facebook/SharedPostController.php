<?php

namespace App\Http\Controllers\Facebook;

use Illuminate\Http\Request;
use App\Models\PageAccessToken;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class SharedPostController extends Controller
{

    public function index(){
        return view('facebook.sharepost');
    }

    public function sharePost(Request $request){
        $request->validate([
            "group_id"=>"required",
            "message"=>"required",
            "post_id"=>"required",
        ]);
        $group_ids = explode("\r\n", $request->group_id);
        $count = count($group_ids);
        $postId = $request->post_id;
        $message = $request->message;

        $accessTokens = PageAccessToken::pluck('page_access_token')->all();
        shuffle($accessTokens);
        $count_accessTokens = count($accessTokens);
        $j = 0;
        $responses=[];
        for ($i = 0; $i < $count; $i++) {
            if ($j >= $count_accessTokens) {
                $j = 0;
            }
            $access_token = $accessTokens[$j];
            $group_id = $group_ids[$i];
            $data = [
                'link' => "https://www.facebook.com/$postId",
                'message' => $message,
                'access_token' => $access_token,
            ];
            $response = Http::post("https://graph.facebook.com/v18.0/$group_id/feed", $data);
            if (isset($response['id'])) {
                $responses[] = $response['id'];
            }
            $j++;
        }
        return $responses;
    }

}
