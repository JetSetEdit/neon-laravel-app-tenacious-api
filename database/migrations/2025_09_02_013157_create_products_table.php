<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');                    // Product name
            $table->string('product_code')->unique();  // A944, K969, etc.
            $table->text('description');               // Description
            $table->text('application')->nullable();   // Optional application info
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['product_code']);
            $table->index(['category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
