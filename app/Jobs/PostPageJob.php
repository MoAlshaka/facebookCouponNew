<?php

namespace App\Jobs;

use App\Models\PageAccessToken;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

class PostPageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $message;
    protected $photo;
    protected $customDelay;

    public function __construct($message, $photo, $customDelay)
    {
        $this->message = $message;
        $this->photo = $photo;
        $this->customDelay = $customDelay;
    }

    /**
     * Execute the job.
     */
    public function handle(): array
    {
        $message = $this->message;
        $photo = $this->photo;
        $customDelay = $this->customDelay;

        // Your existing logic here
        $pages = PageAccessToken::pluck('page_access_token', 'page_id')->all();
        $responses = [];
        $batchSize = 10;

        foreach (array_chunk($pages, $batchSize, true) as $batch) {
            foreach ($batch as $page_id => $page_access_token) {
                $response = Http::post("https://graph.facebook.com/v18.0/$page_id/photos", [
                    'message' => $message,
                    'url' => $photo,
                    'access_token' => $page_access_token,
                ]);

                if (isset($response['post_id'])) {
                    $responses[] = $response['post_id'];
                }
                sleep($customDelay);
            }
        }
        return $responses;
        // Handle or log the responses as needed
    }

}
