<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log; // Tambahkan ini

class RequestLogger
{
    public function handle(Request $request, Closure $next): Response
    {
        // Mencatat request yang masuk ke log
        Log::info('Request diterima: ' . $request->method() . ' ' . $request->path());

        return $next($request);
    }
}