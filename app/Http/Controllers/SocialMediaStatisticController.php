<?php

namespace App\Http\Controllers;

use App\Models\SocialMediaAccount;
use App\Models\SocialMediaStatistic;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SocialMediaStatisticController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $statistics = SocialMediaStatistic::with('account')
            ->orderBy('record_date', 'desc')
            ->paginate(20);

        return view('statistics.index', compact('statistics'));
    }

    public function create()
    {
        $accounts = SocialMediaAccount::where('is_active', true)->get();
        return view('statistics.create', compact('accounts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'social_media_account_id' => 'required|exists:social_media_accounts,id',
            'followers' => 'required|integer|min:0',
            'following' => 'required|integer|min:0',
            'posts_count' => 'required|integer|min:0',
            'engagement' => 'required|integer|min:0',
            'engagement_rate' => 'required|numeric|min:0|max:100',
            'record_date' => 'required|date'
        ]);

        SocialMediaStatistic::create($validated);

        return redirect()->route('statistics.index')
            ->with('success', 'Statistik berhasil ditambahkan!');
    }

    public function edit(SocialMediaStatistic $statistic)
    {
        $accounts = SocialMediaAccount::where('is_active', true)->get();
        return view('statistics.edit', compact('statistic', 'accounts'));
    }

    public function update(Request $request, SocialMediaStatistic $statistic)
    {
        $validated = $request->validate([
            'social_media_account_id' => 'required|exists:social_media_accounts,id',
            'followers' => 'required|integer|min:0',
            'following' => 'required|integer|min:0',
            'posts_count' => 'required|integer|min:0',
            'engagement' => 'required|integer|min:0',
            'engagement_rate' => 'required|numeric|min:0|max:100',
            'record_date' => 'required|date'
        ]);

        $statistic->update($validated);

        return redirect()->route('statistics.index')
            ->with('success', 'Statistik berhasil diupdate!');
    }

    public function destroy(SocialMediaStatistic $statistic)
    {
        $statistic->delete();

        return redirect()->route('statistics.index')
            ->with('success', 'Statistik berhasil dihapus!');
    }
}