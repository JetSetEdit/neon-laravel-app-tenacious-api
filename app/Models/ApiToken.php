<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ApiToken extends Model
{
    protected $fillable = [
        'name',
        'token_hash',
        'client_type',
        'rate_limit',
        'is_active',
        'expires_at',
        'description'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'expires_at' => 'datetime',
        'rate_limit' => 'integer'
    ];

    /**
     * Generate a new API token
     */
    public static function generateToken(): string
    {
        return 'tt_' . Str::random(32);
    }

    /**
     * Hash a token for storage
     */
    public static function hashToken(string $token): string
    {
        return Hash::make($token);
    }

    /**
     * Check if a token is valid
     */
    public static function validateToken(string $token): ?self
    {
        return static::where('is_active', true)
            ->where('expires_at', '>', now())
            ->orWhere('expires_at', null)
            ->get()
            ->first(function ($apiToken) use ($token) {
                return Hash::check($token, $apiToken->token_hash);
            });
    }

    /**
     * Check if token is expired
     */
    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    /**
     * Check if token is active
     */
    public function isActive(): bool
    {
        return $this->is_active && !$this->isExpired();
    }
}
