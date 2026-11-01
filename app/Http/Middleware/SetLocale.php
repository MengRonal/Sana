<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * ភាសាដែលអនុញ្ញាតឲ្យប្រើ
     */
    private array $supported = ['en', 'km'];

    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // យកភាសាដែលបានរក្សាទុកក្នុង session (បើគ្មាន ប្រើភាសាលំនាំដើមក្នុង config/app.php)
        $locale = session('locale', config('app.locale'));

        if (in_array($locale, $this->supported, true)) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}