<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the Single Sided category
        $category = \App\Models\Category::create([
            'name' => 'Single Sided',
            'description' => 'Single-sided adhesive tapes'
        ]);
        
        // Add all 7 tape products to this category
        $this->createAllTapeProducts($category->id);
    }

    private function createAllTapeProducts($categoryId)
    {
        $products = [
            [
                'name' => 'Premium Gaffer Tape',
                'product_code' => 'A944',
                'description' => 'Premium gaffer tape, strong adhesion, easy tear.',
                'application' => 'Stage, events, temporary hold.'
            ],
            [
                'name' => 'Heavy-Duty Cloth Tape',
                'product_code' => 'K969',
                'description' => 'Heavy-duty cloth tape with waterproof backing.',
                'application' => 'General repairs, bundling.'
            ],
            [
                'name' => 'All-Purpose Cloth Tape',
                'product_code' => 'K909',
                'description' => 'All-purpose cloth tape, good tack on rough surfaces.',
                'application' => 'Packaging, sealing, maintenance.'
            ],
            [
                'name' => 'Low-Residue Gaffer Tape',
                'product_code' => 'AT760',
                'description' => 'Low-residue gaffer, clean removal.',
                'application' => 'Event rigging, cables.'
            ],
            [
                'name' => 'Industrial-Grade Cloth Tape',
                'product_code' => 'FL166',
                'description' => 'Industrial-grade cloth, durable and flexible.',
                'application' => 'Construction, warehouse use.'
            ],
            [
                'name' => 'Strong Adhesive Cloth Tape',
                'product_code' => 'PT159',
                'description' => 'Strong adhesive, easy unwind.',
                'application' => 'General purpose binding.'
            ],
            [
                'name' => 'Reinforced Cloth Tape',
                'product_code' => 'KD960',
                'description' => 'Reinforced cloth tape for demanding environments.',
                'application' => 'Heavy-duty sealing, repairs.'
            ]
        ];

        foreach ($products as $product) {
            $product['category_id'] = $categoryId;
            \App\Models\Product::create($product);
        }
    }
}
