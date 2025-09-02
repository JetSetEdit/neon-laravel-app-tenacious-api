<?php

namespace App\Http\Middleware;

use App\Models\ApiToken;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TokenAuth
{
    public function handle(Request $request, Closure $next)
    {
        $token = Session::get('authenticated_token');
        
        if (!$token) {
            return redirect()->route('auth.token-form');
        }
        
        $apiToken = ApiToken::validateToken($token);
        
        if (!$apiToken || !$apiToken->isActive()) {
            Session::forget(['authenticated_token', 'partner_name', 'partner_type']);
            return redirect()->route('auth.token-form')->withErrors(['token' => 'Your session has expired. Please log in again.']);
        }
        
        // Add token info to request for use in controllers
        $request->merge([
            'current_token' => $apiToken,
            'partner_name' => $apiToken->name,
            'partner_type' => $apiToken->client_type
        ]);
        
        return $next($request);
    }
}
