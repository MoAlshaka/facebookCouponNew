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
        $messages = explode("\r\n", $request->message);
        $pages = PageAccessToken::where('user_id', auth()->user()->id)->pluck('page_access_token', 'page_id')->all();
        // $message = $request->message;
        $post_id = $request->post_id;
        $delay = $request->delay;
        $count = count($messages);
        $responses = [];
        $error=[];
        $batchSize = 10;
        $j=0;
        foreach (array_chunk($pages, $batchSize, true) as $batch) {
            try{
                foreach ($batch as $page_id => $page_access_token) {
                    if ($j >= $count) {
                        $j = 0;
                    }
                        $response = Http::post("https://graph.facebook.com/v18.0/$post_id/comments", [
                            'message' => $messages[$j],
                            'access_token' => $page_access_token,
                        ]);
                        if (isset($response['id'])) {
                            $responses[] = $response['id'];
                        }
                        $j++;
                        sleep($delay);
                }
            }catch (\Exception $e) {
                $error[] = ['page_id' => $page_id, 'exception' => $e->getMessage()];
            }
        }

        return $responses;

    }
}
