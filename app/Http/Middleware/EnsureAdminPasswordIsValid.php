<?php
// app/Http/Middleware/EnsureAdminPasswordIsValid.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminPasswordIsValid
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
	 */
	public function handle(Request $request, Closure $next): Response
	{
		/*
		// only allow access to the admin console if correct password entered
		if ($request->input('password') !== 'admin-password') {
			// redirect users back to the homepage otherwise
			return redirect('/');
		}
		*/
		// pass the request deeper into the application
		return $next($request);
	}
}
