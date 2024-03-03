<?php

namespace Noorfarooqy\SchoolModule;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Noorfarooqy\SchoolModule\Providers\SchoolModuleEventServiceProvider;
use Noorfarooqy\SchoolModule\Checkers\SchoolMiddleware;

class SchoolModuleServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'scm-migrations');

        $this->publishes([
            __DIR__ . '/../config/school_module.php' => config_path('school_module.php'),
        ], 'scm-configs');

        $router->middlewareGroup('scm', [
            SchoolMiddleware::class,
        ]);
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'scm');
    }

    public function register()
    {
        $this->app->register(SchoolModuleEventServiceProvider::class);
        // Event::subscribe(\Noorfarooqy\SchoolModule\Subscribers\UserRegisteredEventListener::class);
    }
}
