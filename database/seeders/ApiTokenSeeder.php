<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ApiToken;

class ApiTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tokens = [
            [
                'name' => 'Creator/Developer',
                'token_hash' => ApiToken::hashToken('creator_dev_2024'),
                'client_type' => 'developer',
                'rate_limit' => 0, // unlimited
                'description' => 'Developer access with unlimited requests'
            ],
            [
                'name' => 'ATA Distributors',
                'token_hash' => ApiToken::hashToken('ata_live_abc123'),
                'client_type' => 'platinum',
                'rate_limit' => 1000,
                'description' => 'Platinum client - 1000 requests per day'
            ],
            [
                'name' => 'NDA Distributors',
                'token_hash' => ApiToken::hashToken('nda_live_xyz789'),
                'client_type' => 'platinum',
                'rate_limit' => 1000,
                'description' => 'Platinum client - 1000 requests per day'
            ],
            [
                'name' => 'Test Client',
                'token_hash' => ApiToken::hashToken('test_key_123'),
                'client_type' => 'test',
                'rate_limit' => 100,
                'description' => 'Test client - 100 requests per day'
            ]
        ];

        foreach ($tokens as $token) {
            ApiToken::create($token);
        }
    }
}
