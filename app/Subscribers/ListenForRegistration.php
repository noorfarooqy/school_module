<?php

namespace Noorfarooqy\SchoolModule\Subscribers;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Noorfarooqy\NoorAuth\Events\UserRegisteredEvent;

class ListenForRegistration
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        Log::info("Listner initialized");
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegisteredEvent $event): void
    {
        $user = $event->user;
        $user->user_type = 'admin';
        $user->save();
        $user->givePermissionTo(['scm_write', 'scm_read']);
    }
}
