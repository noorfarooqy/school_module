<?php

use App\Http\Middleware\SchoolMiddleware;

return [
    'is_activated' => env('HAS_SCM', false),
];
