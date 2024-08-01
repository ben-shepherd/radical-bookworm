<?php

declare(strict_types=1);

namespace App\Domains\Books\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BooksMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $authorization = $request->header('Authorization');

        if (empty($authorization) || str_replace('Bearer ', '', $authorization) !== config('auth.basicApiToken')) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = User::query()->firstOrFail();

        Auth::login($user);

        return $next($request);
    }
}
