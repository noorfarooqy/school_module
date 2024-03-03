<?php

namespace Noorfarooqy\SchoolModule\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Noorfarooqy\NoorAuth\Events\UserRegisteredEvent;
use Noorfarooqy\SchoolModule\Events\NewSchoolRegistered;
use Noorfarooqy\SchoolModule\Subscribers\ListenForNewSchoolRegistered;
use Noorfarooqy\SchoolModule\Subscribers\ListenForRegistration;

class SchoolModuleEventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        UserRegisteredEvent::class => [
            ListenForRegistration::class,
        ],
        NewSchoolRegistered::class => [
            ListenForNewSchoolRegistered::class,
        ],
        
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
