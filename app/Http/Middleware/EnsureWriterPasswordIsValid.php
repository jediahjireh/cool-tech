<?php
// app/Http/Middleware/EnsureWriterPasswordIsValid.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class EnsureWriterPasswordIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /*
        // check if the session indicates the user is logged in as a writer
        if (!Session::has('is_writer_logged_in')) {

        }
        */

        // pass the request deeper into the application
        return $next($request);
    }
}
