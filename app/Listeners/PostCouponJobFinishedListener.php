<?php

namespace App\Listeners;

use App\Events\PostCouponJobFinished;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;



class PostCouponJobFinishedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostCouponJobFinished $event): void
    {
        $message = $event->message;

        return view('facebook.finishpost', ['message' => $message]);
    }
}
