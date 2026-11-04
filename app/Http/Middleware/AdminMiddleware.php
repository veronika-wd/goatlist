<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->email !== 'admin@mail.ru' && !Hash::check($request->password, Hash::make('myGoatWishList#3422'))) {
            return redirect()->back()->withErrors([
                'auth' => 'You are not admin',
            ]);
        }

        return $next($request);
    }
}
