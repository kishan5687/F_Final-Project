<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureLoggedIn
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->get('isLoggedIn')) {
            return redirect('/login')
                ->with('error', 'You must login first.');
        }

        return $next($request);
    }
}
