<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of products
     */
    public function index(Request $request)
    {
        $category = $request->query('category');
        $search = $request->query('search');
        
        $query = Product::query();
        
        if ($category) {
            $query->where('category_id', $category);
        }
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('product_code', 'like', "%{$search}%");
            });
        }
        
        $products = $query->with('category')->paginate(12);
        $categories = Category::all();
        
        // Get partner info from middleware
        $partner_name = $request->input('partner_name');
        
        return view('products.index', compact('products', 'categories', 'category', 'search', 'partner_name'));
    }

    /**
     * Display the specified product
     */
    public function show(Request $request, $id)
    {
        $product = Product::with('category')->findOrFail($id);
        
        // Get partner info from middleware
        $partner_name = $request->input('partner_name');
        
        return view('products.show', compact('product', 'partner_name'));
    }
}
