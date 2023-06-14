<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\AdResponse;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChatListener
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
    public function handle(object $event): void
    {
        $user=User::select('id','name','email')->find($event->chat->adresser_id);
        $user->notify(new AdResponse($event->chat));
    }
}
