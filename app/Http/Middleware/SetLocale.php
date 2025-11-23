<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = session('locale', config('app.locale'));
        
        if (in_array($locale, ['en', 'fr', 'es', 'ar'])) {
            app()->setLocale($locale);
        } else {
            // Fallback to English if invalid locale
            app()->setLocale('en');
            session()->put('locale', 'en');
        }
        
        // Ensure fallback locale is always English
        app()->setFallbackLocale('en');
        
        return $next($request);
    }
}
