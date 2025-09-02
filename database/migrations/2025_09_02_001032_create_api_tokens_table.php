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
        Schema::create('api_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('name');                    // Client name (e.g., "ATA Distributors")
            $table->string('token_hash')->unique();    // Hashed API token
            $table->string('client_type');             // platinum, developer, test
            $table->integer('rate_limit');             // Requests per day
            $table->boolean('is_active')->default(true); // Can disable tokens
            $table->timestamp('expires_at')->nullable(); // Optional expiration
            $table->text('description')->nullable();   // Additional notes
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['token_hash']);
            $table->index(['client_type']);
            $table->index(['is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_tokens');
    }
};
