<?php

namespace App\Http\Controllers;

use App\Models\SocialMediaAccount;
use Illuminate\Http\Request;

class SocialMediaAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $accounts = SocialMediaAccount::with('latestStatistic')
            ->orderBy('platform')
            ->get();

        return view('accounts.index', compact('accounts'));
    }

    public function create()
    {
        return view('accounts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'platform' => 'required|in:facebook,instagram,twitter,youtube,tiktok',
            'account_name' => 'required|string|max:255',
            'account_url' => 'required|url|max:255',
            'account_id' => 'nullable|string|max:255',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');

        SocialMediaAccount::create($validated);

        return redirect()->route('accounts.index')
            ->with('success', 'Akun sosial media berhasil ditambahkan!');
    }

    public function show(SocialMediaAccount $account)
    {
        $account->load(['statistics' => function($query) {
            $query->orderBy('record_date', 'desc')->limit(30);
        }, 'posts' => function($query) {
            $query->orderBy('posted_at', 'desc')->limit(20);
        }]);

        return view('accounts.show', compact('account'));
    }

    public function edit(SocialMediaAccount $account)
    {
        return view('accounts.edit', compact('account'));
    }

    public function update(Request $request, SocialMediaAccount $account)
    {
        $validated = $request->validate([
            'platform' => 'required|in:facebook,instagram,twitter,youtube,tiktok',
            'account_name' => 'required|string|max:255',
            'account_url' => 'required|url|max:255',
            'account_id' => 'nullable|string|max:255',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');

        $account->update($validated);

        return redirect()->route('accounts.index')
            ->with('success', 'Akun sosial media berhasil diupdate!');
    }

    public function destroy(SocialMediaAccount $account)
    {
        $account->delete();

        return redirect()->route('accounts.index')
            ->with('success', 'Akun sosial media berhasil dihapus!');
    }
}