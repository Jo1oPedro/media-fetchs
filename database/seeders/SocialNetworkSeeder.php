<?php

namespace Database\Seeders;

use App\Models\SocialNetwork;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialNetworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SocialNetwork::insert([
            [
                'name' => 'YouTube',
                'slug' => 'youtube',
                'base_url' => 'https://www.youtube.com',
            ],
            [
                'name' => 'X',
                'slug' => 'x',
                'base_url' => 'https://x.com',
            ],
            [
                'name' => 'Instagram',
                'slug' => 'instagram',
                'base_url' => 'https://www.instagram.com',
            ],
            [
                'name' => 'Facebook',
                'slug' => 'facebook',
                'base_url' => 'https://www.facebook.com',
            ],
            [
                'name' => 'TikTok',
                'slug' => 'tiktok',
                'base_url' => 'https://www.tiktok.com',
            ],
        ]);
    }
}
