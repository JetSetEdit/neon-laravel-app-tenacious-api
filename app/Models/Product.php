<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'product_code',
        'description',
        'application',
        'category_id'
    ];

    /**
     * Get the category for this product
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Scope for products by category
     */
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }
}
