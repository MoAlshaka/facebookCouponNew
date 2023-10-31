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

    public function share_post_on_page(){
        return view('facebook.sharepostonpage');
    }

    public function sharePost(Request $request){
        $request->validate([
            "group_id"=>"required",
            "message"=>"required",
            "post_id"=>"required",
            "delay"=>"required",
        ]);
        $group_ids = explode("\r\n", $request->group_id);
        $count = count($group_ids);
        $postId = $request->post_id;
        $message = $request->message;
        $delay = $request->delay;
        $accessTokens = PageAccessToken::where('user_id', auth()->user()->id)->pluck('page_access_token')->all();
        shuffle($accessTokens);
        $count_accessTokens = count($accessTokens);
        $j = 0;
        $error=[];
        $responses=[];
        for ($i = 0; $i < $count; $i++) {
            try{
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
                sleep($delay);
            }catch (\Exception $e) {
                $error[]=$group_id;
            }
        }
        return  $responses;
    }

    public function sharePostPage(Request $request) {
        $request->validate([
            "message" => "required",
            "post_id" => "required",
            "delay" => "required",
        ]);

        $postId = $request->post_id;
        $message = $request->message;
        $delay = $request->delay;

        $pages = PageAccessToken::where('user_id', auth()->user()->id)->pluck('page_access_token', 'page_id')->all();
        $responses = [];
        $error=[];
        foreach ($pages as $pageId => $pageAccessToken) {
            try{
                $data = [
                    'link' => "https://www.facebook.com/$postId",
                    'message' => $message,
                    'access_token' => $pageAccessToken,
                ];

                $response = Http::post("https://graph.facebook.com/v18.0/$pageId/feed", $data);

                if (isset($response['id'])) {
                    $responses[] = $response['id'];
                }

                sleep($delay);
            }catch (\Exception $e) {
                $error[]=$pageId;
            }
        }
        return $responses;

    }



}
