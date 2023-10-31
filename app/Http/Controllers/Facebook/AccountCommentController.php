<?php

namespace App\Http\Controllers\Facebook;

use App\Http\Controllers\Controller;
use App\Models\AccountAccessToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AccountCommentController extends Controller
{
    public function account_comment(){
        return view('facebook.accountcomment');
    }

    public function account_like(){
        return view('facebook.accountlike');
    }

    public function comment(Request $request) {
        $request->validate([
            "post_id" => "required",
            "message" => "required",
            "delay" => "required",
        ]);

        $messages = explode("\r\n", $request->message);
        $post_ids = explode("\r\n", $request->post_id);
        $accounts = AccountAccessToken::pluck('account_access_token', 'account_id')->all();
        $delay = $request->delay;
        $count = count($messages);
        $responses = [];
        $errors = [];

        $batchSize = 10;
        foreach($post_ids as $post_id){
            foreach (array_chunk($accounts, $batchSize, true) as $batch) {
                $j = 0;
                try {
                    foreach ($batch as $account_id => $account_access_token) {
                        if ($j >= $count) {
                            $j = 0;
                        }
                        $response = Http::post("https://graph.facebook.com/v18.0/$post_id/comments", [
                            'message' => $messages[$j],
                            'access_token' => $account_access_token,
                        ]);

                        if ($response->successful()) {
                            $commentData = $response->json();
                            $commentId = $commentData['id'];
                            $responses[] = $commentId;
                        } else {
                            // Handle the case where the comment was not posted successfully
                            $errors[] = ['account_id' => $account_id, 'exception' => 'Comment was not posted'];
                        }

                        $j++;
                        // Apply delay after posting each comment
                        sleep($delay);
                    }
                } catch (\Exception $e) {
                    // Handle or log the exception
                    $errors[] = ['account_id' => $account_id, 'exception' => $e->getMessage()];
                }
            }
        }

        return [
            'responses' => $responses,
            'errors' => $errors,
        ];
    }

    public function like(Request $request) {
        $request->validate([
            "post_id" => "required",
            "delay" => "required",
        ]);

        $post_ids = explode("\r\n", $request->post_id);
        $delay = $request->delay;
        $accounts = AccountAccessToken::where('user_id', auth()->user()->id)->pluck('account_access_token')->all();

        $responses = []; // Array to store responses for each post
        $errors = [];    // Array to store errors for each post

        foreach ($post_ids as $post_id) {
            foreach ($accounts as $access_token) {
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
