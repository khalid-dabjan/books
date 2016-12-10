<?php

namespace App\Listeners;

use App\Events\comparingBooks;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMatchFoundNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  comparingBooks  $event
     * @return void
     */
    public function handle(BookMatch $event)
    {
        if
    }
}
