<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $domain = $request->getHost();    // like a.localhost
        $tenant = \App\Models\Store::where('domain', $domain)->firstOrFail();   // Select * from stores where domain = a.localhost
        if (!$tenant) {    // if tenant not found like the main tenant (localhost)
            return $next($request);
        }
        app()->instance('store.active', $tenant);  // add tenant to Service container
        return $next($request);
    }
}
