<?php

namespace App\Http\Controllers\Facebook;

use App\Http\Controllers\Controller;
use App\Models\PageAccessToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostPageCouponController extends Controller
{
    public function index(){
        return view('facebook.pagepost');
    }

    public function post(Request $request){
        $request->validate([
            "message"=>"required",
            "delay"=>"required",
            "photo"=>"required|url",
        ]);
        $pages = PageAccessToken::pluck('page_access_token', 'page_id')->all();
        $message = $request->message;
        $image = $request->photo;
        $delay = $request->delay;
        $responses = [];
        $batchSize = 10;
        foreach (array_chunk($pages, $batchSize, true) as $batch) {
            foreach ($batch as $page_id => $page_access_token) {
                $response = Http::post("https://graph.facebook.com/v18.0/$page_id/photos", [
                    'message' => $message,
                    'url' => $image,
                    'access_token' => $page_access_token,
                ]);
                if (isset($response['post_id'])) {
                    $responses[] = $response['post_id'];
                }
                sleep($delay);
            }
        }

        return $responses;
    }

}
