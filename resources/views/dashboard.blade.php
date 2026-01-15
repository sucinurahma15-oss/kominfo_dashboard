@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h2 mb-2" style="color: var(--primary-blue); font-weight: 700;">
                <i class="fas fa-chart-line"></i> Dashboard Statistik Sosial Media
            </h1>
            <p class="text-muted mb-0">Monitoring dan analisis performa akun sosial media Dinas Kominfo Kota Binjai</p>
        </div>
    </div>

    <div class="row mb-4 g-4">
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card blue h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted text-uppercase mb-1" style="font-size: 0.85rem; font-weight: 600;">
                                Total Followers
                            </p>
                            <h3 class="mb-0" style="color: var(--primary-blue); font-weight: 700;">
                                {{ number_format($totalFollowers) }}
                            </h3>
                        </div>
                        <div>
                            <i class="fas fa-users stat-icon" style="color: var(--primary-blue);"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-card orange h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted text-uppercase mb-1" style="font-size: 0.85rem; font-weight: 600;">
                                Total Engagement
                            </p>
                            <h3 class="mb-0" style="color: var(--primary-orange); font-weight: 700;">
                                {{ number_format($totalEngagement) }}
                            </h3>
                        </div>
                        <div>
                            <i class="fas fa-heart stat-icon" style="color: var(--primary-orange);"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-card green h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted text-uppercase mb-1" style="font-size: 0.85rem; font-weight: 600;">
                                Avg Engagement Rate
                            </p>
                            <h3 class="mb-0" style="color: #28a745; font-weight: 700;">
                                {{ number_format($avgEngagementRate, 2) }}%
                            </h3>
                        </div>
                        <div>
                            <i class="fas fa-percentage stat-icon" style="color: #28a745;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-card purple h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted text-uppercase mb-1" style="font-size: 0.85rem; font-weight: 600;">
                                Growth (30 Days)
                            </p>
                            <h3 class="mb-0" style="color: #6f42c1; font-weight: 700;">
                                {{ $followerGrowth > 0 ? '+' : '' }}{{ number_format($followerGrowth, 2) }}%
                            </h3>
                        </div>
                        <div>
                            <i class="fas fa-chart-line stat-icon" style="color: #6f42c1;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4 g-4">
        <div class="col-xl-8">
            <div class="card shadow-sm h-100">
                <div class="card-header" style="background: linear-gradient(135deg, var(--primary-blue) 0%, #0066CC 100%); color: white;">
                    <h6 class="mb-0">
                        <i class="fas fa-chart-area"></i> Pertumbuhan Followers (30 Hari Terakhir)
                    </h6>
                </div>
                <div class="card-body">
                    <canvas id="followersChart" height="80"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card shadow-sm h-100">
                <div class="card-header" style="background: linear-gradient(135deg, var(--primary-orange) 0%, #ff8c42 100%); color: white;">
                    <h6 class="mb-0">
                        <i class="fas fa-share-alt"></i> Platform Sosial Media
                    </h6>
                </div>
                <div class="card-body">
                    @foreach($accounts as $account)
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-capitalize d-flex align-items-center gap-2">
                                <i class="fab fa-{{ $account->platform }} fa-lg social-icon" style="color: 
                                    @if($account->platform == 'facebook') #3b5998
                                    @elseif($account->platform == 'instagram') #E1306C
                                    @elseif($account->platform == 'twitter') #1DA1F2
                                    @elseif($account->platform == 'youtube') #FF0000
                                    @elseif($account->platform == 'tiktok') #000000
                                    @endif
                                "></i>
                                <strong>{{ ucfirst($account->platform) }}</strong>
                            </span>
                            <span class="badge" style="background: 
                                @if($account->platform == 'facebook') #3b5998
                                @elseif($account->platform == 'instagram') #E1306C
                                @elseif($account->platform == 'twitter') #1DA1F2
                                @elseif($account->platform == 'youtube') #FF0000
                                @elseif($account->platform == 'tiktok') #000000
                                @endif
                            ">
                                {{ number_format($account->latestStatistic->followers ?? 0) }}
                            </span>
                        </div>
                        <div class="progress" style="height: 8px; border-radius: 10px;">
                            <div class="progress-bar" role="progressbar" 
                                style="width: {{ ($account->latestStatistic->followers ?? 0) / ($totalFollowers ?: 1) * 100 }}%; 
                                             background: 
                                @if($account->platform == 'facebook') #3b5998
                                @elseif($account->platform == 'instagram') #E1306C
                                @elseif($account->platform == 'twitter') #1DA1F2
                                @elseif($account->platform == 'youtube') #FF0000
                                @elseif($account->platform == 'tiktok') #000000
                                @endif
                                ; border-radius: 10px;">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header" style="background-color: var(--light-blue);">
                    <h6 class="mb-0" style="color: var(--primary-blue);">
                        <i class="fas fa-bolt"></i> Quick Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <a href="{{ route('accounts.create') }}" class="btn btn-primary w-100">
                                <i class="fas fa-plus-circle"></i> Tambah Akun
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('statistics.create') }}" class="btn btn-success w-100">
                                <i class="fas fa-chart-bar"></i> Input Statistik
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('accounts.index') }}" class="btn btn-warning w-100">
                                <i class="fas fa-list"></i> Kelola Akun
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('export.form') }}" class="btn btn-dark w-100">
                                <i class="fas fa-file-export"></i> Export Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Followers Growth Chart
    const ctx = document.getElementById('followersChart');
    
    if (!ctx) {
        console.error('Canvas element not found!');
        return;
    }
    
    const chartData = @json($chartData);
    
    console.log('Chart Data:', chartData); // Debug
    
    if (!chartData || !chartData.labels || !chartData.datasets) {
        console.error('Invalid chart data!');
        return;
    }
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartData.labels,
            datasets: chartData.datasets
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
                    labels: {
                        font: {
                            family: 'Poppins',
                            size: 12
                        },
                        padding: 15,
                        usePointStyle: true,
                        boxWidth: 10,
                        boxHeight: 10
                    }
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleFont: {
                        family: 'Poppins',
                        size: 13,
                        weight: 'bold'
                    },
                    bodyFont: {
                        family: 'Poppins',
                        size: 12
                    },
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += new Intl.NumberFormat('id-ID').format(context.parsed.y) + ' followers';
                            }
                            return label;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return new Intl.NumberFormat('id-ID').format(value);
                        },
                        font: {
                            family: 'Poppins',
                            size: 11
                        }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)',
                        drawBorder: false
                    }
                },
                x: {
                    ticks: {
                        font: {
                            family: 'Poppins',
                            size: 11
                        },
                        maxRotation: 45,
                        minRotation: 45
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
});
</script>
@endpush
@endsection