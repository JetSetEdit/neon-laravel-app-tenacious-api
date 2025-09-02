<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ApiToken;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * List all active products
     */
    public function index(Request $request)
    {
        try {
            // Validate API key
            $token = $this->validateApiKey($request);
            if (!$token) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid or missing API key',
                    'error' => 'unauthorized'
                ], 401);
            }

            // Get query parameters
            $category = $request->query('category');

            // Build query
            $query = Product::query();

            if ($category) {
                $query->byCategory($category);
            }

            // Get products with pagination
            $products = $query->paginate(20);

            return response()->json([
                'status' => 'success',
                'message' => 'Products retrieved successfully',
                'data' => $products->items(),
                'pagination' => [
                    'current_page' => $products->currentPage(),
                    'last_page' => $products->lastPage(),
                    'per_page' => $products->perPage(),
                    'total' => $products->total()
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve products',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get a specific product by ID
     */
    public function show(Request $request, $id)
    {
        try {
            // Validate API key
            $token = $this->validateApiKey($request);
            if (!$token) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid or missing API key',
                    'error' => 'unauthorized'
                ], 401);
            }

            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Product not found',
                    'error' => 'not_found'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Product retrieved successfully',
                'data' => $product
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve product',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Search products
     */
    public function search(Request $request)
    {
        try {
            // Validate API key
            $token = $this->validateApiKey($request);
            if (!$token) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid or missing API key',
                    'error' => 'unauthorized'
                ], 401);
            }

            $query = $request->query('q');
            if (!$query) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Search query is required',
                    'error' => 'missing_query'
                ], 400);
            }

            $products = Product::where(function($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                      ->orWhere('description', 'like', "%{$query}%")
                      ->orWhere('product_code', 'like', "%{$query}%");
                })
                ->paginate(20);

            return response()->json([
                'status' => 'success',
                'message' => 'Search completed successfully',
                'data' => $products->items(),
                'pagination' => [
                    'current_page' => $products->currentPage(),
                    'last_page' => $products->lastPage(),
                    'per_page' => $products->perPage(),
                    'total' => $products->total()
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Search failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Validate API key
     */
    private function validateApiKey(Request $request)
    {
        $apiKey = $request->header('Authorization');
        if (!$apiKey) {
            return null;
        }

        $apiKey = str_replace('Bearer ', '', $apiKey);
        return ApiToken::validateToken($apiKey);
    }
}
