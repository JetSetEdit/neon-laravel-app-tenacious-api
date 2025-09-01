<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Validate API key and return client information
     */
    public function validate(Request $request)
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

            // Define valid API keys and their client info
            $validKeys = [
                'creator_dev_2024' => [
                    'client' => 'Creator/Developer',
                    'type' => 'developer',
                    'rate_limit' => 'unlimited'
                ],
                'ata_live_abc123' => [
                    'client' => 'ATA Distributors',
                    'type' => 'platinum',
                    'rate_limit' => '1000/day'
                ],
                'nda_live_xyz789' => [
                    'client' => 'NDA Distributors',
                    'type' => 'platinum',
                    'rate_limit' => '1000/day'
                ],
                'test_key_123' => [
                    'client' => 'Test Client',
                    'type' => 'test',
                    'rate_limit' => '100/day'
                ]
            ];

            // Check if the API key is valid
            if (!array_key_exists($apiKey, $validKeys)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid API key',
                    'error' => 'invalid_api_key'
                ], 401);
            }

            // Return client information
            return response()->json([
                'status' => 'success',
                'message' => 'API key validated successfully',
                'data' => [
                    'client' => $validKeys[$apiKey]['client'],
                    'type' => $validKeys[$apiKey]['type'],
                    'rate_limit' => $validKeys[$apiKey]['rate_limit'],
                    'validated_at' => now()->toISOString()
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Authentication validation failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
