<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VendorMiddleware
{
public function handle(Request $request, Closure $next): Response
{
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    $user = auth()->user();

    if (!$user->isVendor()) {
        abort(403, 'Only vendors can access this area.');
    }

    if (!$user->is_active) {
        abort(403, 'Vendor account is not approved.');
    }

    return $next($request);
}

}
