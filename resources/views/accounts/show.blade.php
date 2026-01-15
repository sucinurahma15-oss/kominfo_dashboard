@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">
                        <i class="fab fa-{{ $account->platform }}" style="color: 
                            @if($account->platform == 'facebook') #3b5998
                            @elseif($account->platform == 'instagram') #E1306C
                            @elseif($account->platform == 'twitter') #1DA1F2
                            @elseif($account->platform == 'youtube') #FF0000
                            @elseif($account->platform == 'tiktok') #000000
                            @endif
                        "></i>
                        Detail Akun: {{ $account->account_name }}
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('accounts.index') }}">Akun Sosmed</a></li>
                            <li class="breadcrumb-item active">Detail</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('accounts.edit', $account) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('accounts.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Info -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0"><i class="fas fa-info-circle"></i> Informasi Akun</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="40%">Platform:</th>
                            <td class="text-capitalize">{{ $account->platform }}</td>
                        </tr>
                        <tr>
                            <th>Nama Akun:</th>
                            <td>{{ $account->account_name }}</td>
                        </tr>
                        <tr>
                            <th>URL:</th>
                            <td>
                                <a href="{{ $account->account_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-external-link-alt"></i> Lihat Profil
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>
                                @if($account->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Tidak Aktif</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Dibuat:</th>
                            <td>{{ $account->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0"><i class="fas fa-chart-line"></i> Statistik Terkini</h6>
                </div>
                <div class="card-body">
                    @if($account->latestStatistic)
                    <div class="row text-center">
                        <div class="col-md-3 mb-3">
                            <div class="border rounded p-3">
                                <i class="fas fa-users fa-2x text-primary mb-2"></i>
                                <h4 class="mb-0">{{ number_format($account->latestStatistic->followers) }}</h4>
                                <small class="text-muted">Followers</small>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="border rounded p-3">
                                <i class="fas fa-user-plus fa-2x text-success mb-2"></i>
                                <h4 class="mb-0">{{ number_format($account->latestStatistic->following) }}</h4>
                                <small class="text-muted">Following</small>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="border rounded p-3">
                                <i class="fas fa-image fa-2x text-warning mb-2"></i>
                                <h4 class="mb-0">{{ number_format($account->latestStatistic->posts_count) }}</h4>
                                <small class="text-muted">Posts</small>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="border rounded p-3">
                                <i class="fas fa-heart fa-2x text-danger mb-2"></i>
                                <h4 class="mb-0">{{ number_format($account->latestStatistic->engagement_rate, 2) }}%</h4>
                                <small class="text-muted">Engagement</small>
                            </div>
                        </div>
                    </div>
                    @else
                    <p class="text-center text-muted">Belum ada data statistik</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics History Chart -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-chart-area"></i> Riwayat Statistik (30 Hari Terakhir)</h6>
                </div>
                <div class="card-body">
                    <canvas id="statisticsChart" height="80"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Statistics Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-table"></i> Data Statistik Terbaru</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Followers</th>
                                    <th>Following</th>
                                    <th>Posts</th>
                                    <th>Engagement</th>
                                    <th>Engagement Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($account->statistics as $stat)
                                <tr>
                                    <td>{{ $stat->record_date->format('d M Y') }}</td>
                                    <td>{{ number_format($stat->followers) }}</td>
                                    <td>{{ number_format($stat->following) }}</td>
                                    <td>{{ number_format($stat->posts_count) }}</td>
                                    <td>{{ number_format($stat->engagement) }}</td>
                                    <td>{{ number_format($stat->engagement_rate, 2) }}%</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data statistik</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Statistics History Chart
    const ctx = document.getElementById('statisticsChart').getContext('2d');
    const statistics = @json($account->statistics->reverse()->values());
    
    const labels = statistics.map(stat => {
        const date = new Date(stat.record_date);
        return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
    });
    
    const followersData = statistics.map(stat => stat.followers);
    const engagementData = statistics.map(stat => stat.engagement);
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Followers',
                data: followersData,
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.4,
                yAxisID: 'y',
            }, {
                label: 'Engagement',
                data: engagementData,
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                tension: 0.4,
                yAxisID: 'y1',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                }
            },
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    title: {
                        display: true,
                        text: 'Followers'
                    }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    title: {
                        display: true,
                        text: 'Engagement'
                    },
                    grid: {
                        drawOnChartArea: false,
                    },
                },
            }
        }
    });
</script>
@endpush
@endsection