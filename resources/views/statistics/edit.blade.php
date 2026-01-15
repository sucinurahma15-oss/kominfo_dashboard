@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-edit"></i> Edit Statistik
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('statistics.index') }}">Statistik</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-edit"></i> Form Edit Statistik</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('statistics.update', $statistic) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="social_media_account_id" class="form-label">
                                Akun Sosial Media <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('social_media_account_id') is-invalid @enderror" 
                                    id="social_media_account_id" name="social_media_account_id" required>
                                <option value="">-- Pilih Akun --</option>
                                @foreach($accounts as $account)
                                <option value="{{ $account->id }}" 
                                    {{ old('social_media_account_id', $statistic->social_media_account_id) == $account->id ? 'selected' : '' }}>
                                    {{ ucfirst($account->platform) }} - {{ $account->account_name }}
                                </option>
                                @endforeach
                            </select>
                            @error('social_media_account_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="record_date" class="form-label">
                                Tanggal Record <span class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control @error('record_date') is-invalid @enderror" 
                                   id="record_date" name="record_date" 
                                   value="{{ old('record_date', $statistic->record_date->format('Y-m-d')) }}" required>
                            @error('record_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="followers" class="form-label">
                                    Jumlah Followers <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control @error('followers') is-invalid @enderror" 
                                       id="followers" name="followers" 
                                       value="{{ old('followers', $statistic->followers) }}" min="0" required>
                                @error('followers')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="following" class="form-label">
                                    Jumlah Following <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control @error('following') is-invalid @enderror" 
                                       id="following" name="following" 
                                       value="{{ old('following', $statistic->following) }}" min="0" required>
                                @error('following')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="posts_count" class="form-label">
                                    Jumlah Posts <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control @error('posts_count') is-invalid @enderror" 
                                       id="posts_count" name="posts_count" 
                                       value="{{ old('posts_count', $statistic->posts_count) }}" min="0" required>
                                @error('posts_count')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="engagement" class="form-label">
                                    Total Engagement <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control @error('engagement') is-invalid @enderror" 
                                       id="engagement" name="engagement" 
                                       value="{{ old('engagement', $statistic->engagement) }}" min="0" required>
                                @error('engagement')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="engagement_rate" class="form-label">
                                Engagement Rate (%) <span class="text-danger">*</span>
                            </label>
                            <input type="number" step="0.01" class="form-control @error('engagement_rate') is-invalid @enderror" 
                                   id="engagement_rate" name="engagement_rate" 
                                   value="{{ old('engagement_rate', $statistic->engagement_rate) }}" 
                                   min="0" max="100" required>
                            @error('engagement_rate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('statistics.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auto calculate engagement rate
    document.getElementById('engagement').addEventListener('input', calculateEngagementRate);
    document.getElementById('followers').addEventListener('input', calculateEngagementRate);

    function calculateEngagementRate() {
        const engagement = parseFloat(document.getElementById('engagement').value) || 0;
        const followers = parseFloat(document.getElementById('followers').value) || 0;
        
        if (followers > 0) {
            const rate = (engagement / followers) * 100;
            document.getElementById('engagement_rate').value = rate.toFixed(2);
        }
    }
</script>
@endpush
@endsection