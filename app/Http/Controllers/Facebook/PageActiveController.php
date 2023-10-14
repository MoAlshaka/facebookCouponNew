<?php

namespace App\Http\Controllers\Facebook;

use App\Http\Controllers\Controller;
use App\Models\PageAccessToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PageActiveController extends Controller
{
    public function page_comment(){
        return view('facebook.pagecomment');
    }

    public function comment(Request $request){
        $request->validate([
            "post_id"=>"required",
            "message"=>"required",
            "delay"=>"required",
        ]);
        $pages = PageAccessToken::pluck('page_access_token', 'page_id')->all();
        $message = $request->message;
        $post_id = $request->post_id;
        $delay = $request->delay;
        $responses = [];
        $error=[];
        $batchSize = 10;
        foreach (array_chunk($pages, $batchSize, true) as $batch) {
            try{
            foreach ($batch as $page_id => $page_access_token) {
                    $response = Http::post("https://graph.facebook.com/v18.0/$post_id/comments", [
                        'message' => $message,
                        'access_token' => $page_access_token,
                    ]);
                    if (isset($response['id'])) {
                        $responses[] = $response['id'];
                    }
                    sleep($delay);
            }
            }catch (\Exception $e) {
                $error[]=$page_id;
            }
        }

        return $responses;

    }
}
