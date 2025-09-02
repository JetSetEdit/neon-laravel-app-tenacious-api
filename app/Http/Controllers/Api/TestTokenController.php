<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ApiToken;
use Illuminate\Http\Request;

class TestTokenController extends Controller
{
    /**
     * Test the new token validation system
     */
    public function test(Request $request)
    {
        try {
            // Get the API key from the Authorization header
            $apiKey = $request->header('Authorization');
            
            if (!$apiKey) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'API key is required',
                    'error' => 'missing_api_key'
                ], 401);
            }

            // Remove 'Bearer ' prefix if present
            $apiKey = str_replace('Bearer ', '', $apiKey);

            // Validate token using the new system
            $token = ApiToken::validateToken($apiKey);

            if (!$token) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid or expired API key',
                    'error' => 'invalid_api_key'
                ], 401);
            }

            // Return token information
            return response()->json([
                'status' => 'success',
                'message' => 'Token validated using new system',
                'data' => [
                    'client' => $token->name,
                    'type' => $token->client_type,
                    'rate_limit' => $token->rate_limit === 0 ? 'unlimited' : $token->rate_limit . '/day',
                    'is_active' => $token->isActive(),
                    'expires_at' => $token->expires_at?->toISOString(),
                    'validated_at' => now()->toISOString()
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token validation failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
