<?php

namespace Noorfarooqy\SchoolModule\Subscribers;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Noorfarooqy\NoorAuth\Events\UserRegisteredEvent;
use Noorfarooqy\SchoolModule\Events\NewSchoolRegistered;
use Noorfarooqy\SchoolModule\Mail\NewSchoolRegisteredMail;

class ListenForNewSchoolRegistered
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
    public function handle(NewSchoolRegistered $event): void
    {
        $school = $event->school;
        Mail::to($school->email)->queue(new NewSchoolRegisteredMail($school));
    }
}
