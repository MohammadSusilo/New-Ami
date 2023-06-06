<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */

    protected $addHttpCookie = true;

    protected $except = [
        // use Closure;


        // public function handle($request, Closure $next)
        // {
        //     if(!Auth::check() && $request->route()->named('logout')) {
            
        //         $this->except[] = route('logout');
                
        //     }
            
        //     return parent::handle($request, $next);
        // }
    ];

}
