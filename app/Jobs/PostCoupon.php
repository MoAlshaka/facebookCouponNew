<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\Events\PostCouponJobFinished;

class PostCoupon implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $groupIds;
    protected $message;
    protected $image;
    protected $accessTokens;
    public function __construct($groupIds, $message, $image, $accessTokens)
    {
        $this->groupIds = $groupIds;
        $this->message = $message;
        $this->image = $image;
        $this->accessTokens = $accessTokens;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $count = count($this->groupIds);
        $countAccessTokens = count($this->accessTokens);
        $j = 0;

        for ($i = 0; $i < $count; $i++) {
            if ($j >= $countAccessTokens) {
                $j = 0;
            }

            $accessToken = $this->accessTokens[$j];
            $groupId = $this->groupIds[$i];
            $response=[];
            $response = Http::post("https://graph.facebook.com/v18.0/$groupId/photos", [
                'message' => $this->message,
                'url' => $this->image,
                'access_token' => $accessToken,
            ]);

            $j++;
        }
        return $response;
        // $message="تم نشر البوستات بنجاح";
        // event(new PostCouponJobFinished($message));
    }
}
