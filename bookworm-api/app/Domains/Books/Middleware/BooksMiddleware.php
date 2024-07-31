<?php

declare(strict_types=1);

namespace App\Domains\Books\Middleware;

use Closure;
use Illuminate\Http\Request;

class BooksMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        /**
         * TODO Implement middleware
         */
        
        return $next($request);
    }
}
