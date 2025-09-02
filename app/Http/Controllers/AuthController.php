<?php

namespace App\Http\Controllers;

use App\Models\ApiToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showTokenForm()
    {
        return view('auth.token-form');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'token' => 'required|string'
        ]);

        $token = $request->input('token');
        $apiToken = ApiToken::validateToken($token);

        if (!$apiToken) {
            return back()->withErrors(['token' => 'Invalid or expired API token.']);
        }

        if (!$apiToken->isActive()) {
            return back()->withErrors(['token' => 'This token is inactive.']);
        }

        // Store token info in session
        Session::put('authenticated_token', $token);
        Session::put('partner_name', $apiToken->name);
        Session::put('partner_type', $apiToken->client_type);

        return redirect()->route('products.index');
    }

    public function logout()
    {
        Session::forget(['authenticated_token', 'partner_name', 'partner_type']);
        return redirect()->route('auth.token-form');
    }
}
