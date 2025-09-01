<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HealthController extends Controller
{
    public function index()
    {
        try {
            // Test database connection
            $dbStatus = DB::connection()->getPdo() ? 'connected' : 'disconnected';
            
            return response()->json([
                'status' => 'success',
                'message' => 'API is running successfully',
                'data' => [
                    'version' => '1.0.0',
                    'timestamp' => now()->toISOString(),
                    'database' => $dbStatus,
                    'environment' => config('app.env'),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Health check failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

