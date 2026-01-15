<?php

namespace App\Http\Controllers;

use App\Models\SocialMediaAccount;
use App\Models\SocialMediaStatistic;
use App\Models\SocialMediaPost;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Get all active social media accounts
        $accounts = SocialMediaAccount::with('latestStatistic')
            ->where('is_active', true)
            ->get();

        // Get statistics for the last 30 days
        $startDate = Carbon::now()->subDays(30)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $statisticsRaw = SocialMediaStatistic::where('record_date', '>=', $startDate)
            ->where('record_date', '<=', $endDate)
            ->orderBy('record_date', 'asc')
            ->get();

        $last30Days = $statisticsRaw->groupBy('social_media_account_id');

        // Calculate total followers across all platforms (today)
        $totalFollowers = SocialMediaStatistic::whereDate('record_date', Carbon::today())
            ->sum('followers');

        // If no data today, get latest
        if ($totalFollowers == 0) {
            $totalFollowers = SocialMediaStatistic::selectRaw('MAX(record_date) as latest_date, social_media_account_id')
                ->groupBy('social_media_account_id')
                ->get()
                ->sum(function($item) {
                    return SocialMediaStatistic::where('social_media_account_id', $item->social_media_account_id)
                        ->where('record_date', $item->latest_date)
                        ->sum('followers');
                });
        }

        // Calculate total engagement
        $totalEngagement = SocialMediaStatistic::whereDate('record_date', Carbon::today())
            ->sum('engagement');

        if ($totalEngagement == 0) {
            $totalEngagement = SocialMediaStatistic::selectRaw('MAX(record_date) as latest_date, social_media_account_id')
                ->groupBy('social_media_account_id')
                ->get()
                ->sum(function($item) {
                    return SocialMediaStatistic::where('social_media_account_id', $item->social_media_account_id)
                        ->where('record_date', $item->latest_date)
                        ->sum('engagement');
                });
        }

        // Get average engagement rate
        $avgEngagementRate = SocialMediaStatistic::whereDate('record_date', Carbon::today())
            ->avg('engagement_rate');

        if (!$avgEngagementRate) {
            $avgEngagementRate = SocialMediaStatistic::selectRaw('MAX(record_date) as latest_date, social_media_account_id')
                ->groupBy('social_media_account_id')
                ->get()
                ->avg(function($item) {
                    return SocialMediaStatistic::where('social_media_account_id', $item->social_media_account_id)
                        ->where('record_date', $item->latest_date)
                        ->value('engagement_rate');
                });
        }

        // Get total posts count
        $totalPosts = SocialMediaStatistic::whereDate('record_date', Carbon::today())
            ->sum('posts_count');

        if ($totalPosts == 0) {
            $totalPosts = SocialMediaStatistic::selectRaw('MAX(record_date) as latest_date, social_media_account_id')
                ->groupBy('social_media_account_id')
                ->get()
                ->sum(function($item) {
                    return SocialMediaStatistic::where('social_media_account_id', $item->social_media_account_id)
                        ->where('record_date', $item->latest_date)
                        ->sum('posts_count');
                });
        }

        // Get follower growth (compare today with 30 days ago)
        $followersToday = $totalFollowers;
        
        $followers30DaysAgo = SocialMediaStatistic::whereDate('record_date', Carbon::now()->subDays(30))
            ->sum('followers');

        if ($followers30DaysAgo == 0) {
            // Get oldest date available
            $followers30DaysAgo = SocialMediaStatistic::selectRaw('MIN(record_date) as oldest_date, social_media_account_id')
                ->groupBy('social_media_account_id')
                ->get()
                ->sum(function($item) {
                    return SocialMediaStatistic::where('social_media_account_id', $item->social_media_account_id)
                        ->where('record_date', $item->oldest_date)
                        ->sum('followers');
                });
        }

        $followerGrowth = $followers30DaysAgo > 0 
            ? (($followersToday - $followers30DaysAgo) / $followers30DaysAgo) * 100 
            : 0;

        // Get recent posts
        $recentPosts = SocialMediaPost::with('account')
            ->orderBy('posted_at', 'desc')
            ->limit(10)
            ->get();

        // Prepare chart data for followers growth
        $chartData = $this->prepareChartData($accounts, $last30Days);

        return view('dashboard', compact(
            'accounts',
            'totalFollowers',
            'totalEngagement',
            'avgEngagementRate',
            'totalPosts',
            'followerGrowth',
            'recentPosts',
            'chartData'
        ));
    }

    private function prepareChartData($accounts, $statisticsGrouped)
    {
        $labels = [];
        $datasets = [];

        // Generate labels (dates for last 30 days)
        for ($i = 29; $i >= 0; $i--) {
            $labels[] = Carbon::now()->subDays($i)->format('d M');
        }

        // Colors configuration
        $colors = [
            'facebook' => 'rgb(59, 89, 152)',
            'instagram' => 'rgb(225, 48, 108)',
            'twitter' => 'rgb(29, 161, 242)',
            'youtube' => 'rgb(255, 0, 0)',
            'tiktok' => 'rgb(0, 0, 0)',
        ];

        foreach ($accounts as $account) {
            $data = [];
            $statistics = $statisticsGrouped->get($account->id, collect());
            
            // Variabel bantu untuk mengisi data kosong dengan nilai terakhir
            $lastValue = 0; 

            for ($i = 29; $i >= 0; $i--) {
                $targetDate = Carbon::now()->subDays($i)->format('Y-m-d');
                
                $stat = $statistics->first(function($value) use ($targetDate) {
                    return Carbon::parse($value->record_date)->format('Y-m-d') === $targetDate;
                });

                if ($stat) {
                    $data[] = $stat->followers;
                    $lastValue = $stat->followers; // Update nilai terakhir
                } else {
                    // Gunakan nilai terakhir jika data hari ini kosong (agar grafik tidak putus/turun ke 0)
                    $data[] = $lastValue; 
                }
            }

            // Pastikan key dicari dengan huruf kecil (strtolower)
            $platformKey = strtolower($account->platform);
            $platformColor = $colors[$platformKey] ?? 'rgb(75, 192, 192)'; // Default color cyan

            $datasets[] = [
                'label' => ucfirst($account->platform),
                'data' => $data,
                'borderColor' => $platformColor,
                'backgroundColor' => str_replace('rgb', 'rgba', str_replace(')', ', 0.1)', $platformColor)), // Efek transparan
                'tension' => 0.4,
                'fill' => true, // Ubah ke true agar terlihat lebih bagus
                'pointRadius' => 2,
                'pointHoverRadius' => 5,
                'borderWidth' => 2
            ];
        }

        return [
            'labels' => $labels,
            'datasets' => $datasets
        ];
    }
}