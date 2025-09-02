<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * Get products for this category
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
