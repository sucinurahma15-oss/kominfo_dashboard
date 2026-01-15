<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SocialMediaAccount;
use App\Models\SocialMediaStatistic;
use Carbon\Carbon;

class SocialMediaSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [
            [
                'platform' => 'facebook',
                'account_name' => 'Diskominfo Kota Binjai',
                'account_url' => 'https://facebook.com/diskominfobinjai',
                'is_active' => true
            ],
            [
                'platform' => 'instagram',
                'account_name' => '@diskominfo.binjai',
                'account_url' => 'https://instagram.com/diskominfo.binjai',
                'is_active' => true
            ],
            [
                'platform' => 'twitter',
                'account_name' => '@DiskominfoBinjai',
                'account_url' => 'https://twitter.com/DiskominfoBinjai',
                'is_active' => true
            ],
            [
                'platform' => 'youtube',
                'account_name' => 'Diskominfo Binjai',
                'account_url' => 'https://youtube.com/@diskominfobinjai',
                'is_active' => true
            ],
            [
                'platform' => 'tiktok',
                'account_name' => '@diskominfo.binjai',
                'account_url' => 'https://tiktok.com/@diskominfo.binjai',
                'is_active' => true
            ],
        ];

        foreach ($accounts as $accountData) {
            $account = SocialMediaAccount::create($accountData);

            // Generate statistik untuk 30 hari terakhir
            for ($i = 30; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $followers = rand(1000, 5000) + ($i * 10);
                
                SocialMediaStatistic::create([
                    'social_media_account_id' => $account->id,
                    'followers' => $followers,
                    'following' => rand(100, 500),
                    'posts_count' => rand(50, 200),
                    'engagement' => rand(100, 1000),
                    'engagement_rate' => rand(200, 800) / 100,
                    'record_date' => $date
                ]);
            }
        }
    }
}