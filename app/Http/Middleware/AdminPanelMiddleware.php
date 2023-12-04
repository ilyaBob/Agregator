<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminPanelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()) {
            return $this->redirectToMain($request);
        }

        if (auth()->user()->role != 'admin') {
            return $this->redirectToMain($request);
        }

        return $next($request);
    }

    public function redirectToMain($request): JsonResponse|RedirectResponse
    {
        if($request->expectsJson()){
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return redirect()->route('frontend.main.index');
    }
}
