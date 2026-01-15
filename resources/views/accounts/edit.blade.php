@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-edit"></i> Edit Akun Sosial Media
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('accounts.index') }}">Akun Sosmed</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-edit"></i> Form Edit Akun</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('accounts.update', $account) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="platform" class="form-label">Platform <span class="text-danger">*</span></label>
                            <select class="form-select @error('platform') is-invalid @enderror" id="platform" name="platform" required>
                                <option value="">-- Pilih Platform --</option>
                                <option value="facebook" {{ old('platform', $account->platform) == 'facebook' ? 'selected' : '' }}>
                                    Facebook
                                </option>
                                <option value="instagram" {{ old('platform', $account->platform) == 'instagram' ? 'selected' : '' }}>
                                    Instagram
                                </option>
                                <option value="twitter" {{ old('platform', $account->platform) == 'twitter' ? 'selected' : '' }}>
                                    Twitter / X
                                </option>
                                <option value="youtube" {{ old('platform', $account->platform) == 'youtube' ? 'selected' : '' }}>
                                    YouTube
                                </option>
                                <option value="tiktok" {{ old('platform', $account->platform) == 'tiktok' ? 'selected' : '' }}>
                                    TikTok
                                </option>
                            </select>
                            @error('platform')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="account_name" class="form-label">Nama Akun <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('account_name') is-invalid @enderror" 
                                   id="account_name" name="account_name" value="{{ old('account_name', $account->account_name) }}" 
                                   placeholder="Contoh: Diskominfo Kota Binjai" required>
                            @error('account_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="account_url" class="form-label">URL Akun <span class="text-danger">*</span></label>
                            <input type="url" class="form-control @error('account_url') is-invalid @enderror" 
                                   id="account_url" name="account_url" value="{{ old('account_url', $account->account_url) }}" 
                                   placeholder="https://facebook.com/username" required>
                            @error('account_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="account_id" class="form-label">Account ID <small>(Opsional)</small></label>
                            <input type="text" class="form-control @error('account_id') is-invalid @enderror" 
                                   id="account_id" name="account_id" value="{{ old('account_id', $account->account_id) }}" 
                                   placeholder="ID unik dari platform">
                            @error('account_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                       value="1" {{ old('is_active', $account->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Aktifkan akun ini
                                </label>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('accounts.index') }}" class="btn btn-secondary">
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
@endsection