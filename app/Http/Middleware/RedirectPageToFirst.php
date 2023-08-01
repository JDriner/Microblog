<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;

class RedirectPageToFirst
{
    /**
     * Redirect to first page when page exceeds
     *
     * @param [type] $request
     * @param Closure $next
     * @return 
     */
    public function handle($request, Closure $next)
    {
        $page = $request->input('page', 1); // Get the current page from the request

        // Check if the page number is not a positive integer (invalid value) or non numeric
        if (!is_numeric($page) || intval($page) < 1) {
            // Redirect the user to the first page
            return redirect('home');
        }

        // Continue to the next middleware or the controller
        return $next($request);
    }
}
