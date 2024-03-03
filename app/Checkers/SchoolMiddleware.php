<?php

namespace Noorfarooqy\SchoolModule\Checkers;

use Closure;
use Illuminate\Http\Request;
use Noorfarooqy\NoorAuth\Traits\ResponseHandler;
use Symfony\Component\HttpFoundation\Response;

class SchoolMiddleware
{
    use ResponseHandler;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (config('school_module.is_activated') == false) {
            $this->setError('School module is not actived ' . config('is_activated') . ' - ' . env('HAS_SCM'));
            return $this->getResponse();
        }
        else if($request->user()?->user_type == null || $request->user()?->user_type == 'none'){
            $this->setError('Your user type is not valid, contact administrator for assistance');
            return $this->getResponse();
        }
        return $next($request);
    }
}
