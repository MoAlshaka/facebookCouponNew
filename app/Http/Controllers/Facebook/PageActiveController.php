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

    public function post_like(){
        return view('facebook.postlike');
    }

    // public function comment(Request $request){
    //     $request->validate([
    //         "post_id"=>"required",
    //         "message"=>"required",
    //         "delay"=>"required",
    //     ]);
    //     $messages = explode("\r\n", $request->message);
    //     $pages = PageAccessToken::where('user_id', auth()->user()->id)->pluck('page_access_token', 'page_id')->all();
    //     // $message = $request->message;
    //     $post_ids = explode("\r\n", $request->post_id);
    //     $delay = $request->delay;
    //     $count = count($messages);
    //     $responses = [];
    //     $error=[];
    //     $batchSize = 10;
    //     $j=0;
    //     foreach ($post_ids as $post_id) {
    //         foreach (array_chunk($pages, $batchSize, true) as $batch) {
    //             try{
    //                 foreach ($batch as $page_id => $page_access_token) {
    //                     if ($j >= $count) {
    //                         $j = 0;
    //                     }
    //                         $response = Http::post("https://graph.facebook.com/v18.0/$post_id/comments", [
    //                             'message' => $messages[$j],
    //                             'access_token' => $page_access_token,
    //                         ]);
    //                         if (isset($response['id'])) {
    //                             $responses[] = $response['id'];
    //                         }
    //                         $j++;
    //                         sleep($delay);
    //                 }
    //             }catch (\Exception $e) {
    //                 $error[] = ['page_id' => $page_id, 'exception' => $e->getMessage()];
    //             }
    //         }
    //     }
    //     return $responses;

    // }
    public function comment(Request $request) {
        $request->validate([
            "post_id" => "required",
            "message" => "required",
            "delay" => "required",
        ]);

        $messages = explode("\r\n", $request->message);
        $pages = PageAccessToken::where('user_id', auth()->user()->id)->pluck('page_access_token', 'page_id')->all();
        $post_ids = explode("\r\n", $request->post_id);
        $delay = $request->delay;
        $count = count($messages);
        $responses = [];
        $errors = [];
        $batchSize = 10;

        foreach ($post_ids as $post_id) {
            $j = 0; // Reset the message counter for each post
            foreach (array_chunk($pages, $batchSize, true) as $batch) {
                try {
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
                        } else {
                            // Handle unsuccessful comment here, if needed
                            $errors[] = ['page_id' => $page_id, 'exception' => 'Comment was not posted'];
                        }

                        $j++;
                        sleep($delay); // Add a delay between comments
                    }
                } catch (\Exception $e) {
                    $errors[] = ['page_id' => $page_id, 'exception' => $e->getMessage()];
                }
            }
        }

        // Return an array containing responses and errors for each comment
        return ['responses' => $responses, 'errors' => $errors];
    }



    public function like(Request $request) {
        $request->validate([
            "post_id" => "required",
            "delay" => "required",
        ]);

        $post_ids = explode("\r\n", $request->post_id);
        $delay = $request->delay;
        $pages = PageAccessToken::where('user_id', auth()->user()->id)->pluck('page_access_token')->all();

        $responses = []; // Array to store responses for each post
        $errors = [];    // Array to store errors for each post

        foreach ($post_ids as $post_id) {
            foreach ($pages as $access_token) {
                try {
                    $response = Http::post("https://graph.facebook.com/$post_id/likes", [
                        'access_token' => $access_token,
                    ]);
                    // Store the response for this post
                    $responses[] = $response;
                    sleep($delay);
                } catch (\Exception $e) {
                    // Store the error for this post
                    $errors[] = ['exception' => $e->getMessage()];
                }
            }
        }

        // Return an array containing responses and errors for each post
        return ['responses' => $responses, 'errors' => $errors];
    }


}
