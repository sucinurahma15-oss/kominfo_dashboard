@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0 text-gray-800">
                    <i class="fas fa-share-alt"></i> Manajemen Akun Sosial Media
                </h1>
                <a href="{{ route('accounts.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Akun
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Akun Sosial Media</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">Platform</th>
                                    <th width="25%">Nama Akun</th>
                                    <th width="20%">URL</th>
                                    <th width="15%">Followers Terakhir</th>
                                    <th width="10%">Status</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($accounts as $index => $account)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <i class="fab fa-{{ $account->platform }} fa-2x" style="color: 
                                            @if($account->platform == 'facebook') #3b5998
                                            @elseif($account->platform == 'instagram') #E1306C
                                            @elseif($account->platform == 'twitter') #1DA1F2
                                            @elseif($account->platform == 'youtube') #FF0000
                                            @elseif($account->platform == 'tiktok') #000000
                                            @endif
                                        "></i>
                                        <br>
                                        <span class="text-capitalize">{{ $account->platform }}</span>
                                    </td>
                                    <td>
                                        <strong>{{ $account->account_name }}</strong>
                                    </td>
                                    <td>
                                        <a href="{{ $account->account_url }}" target="_blank" class="text-decoration-none">
                                            <i class="fas fa-external-link-alt"></i> Lihat Profil
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge bg-info text-white">
                                            <i class="fas fa-users"></i> 
                                            {{ number_format($account->latestStatistic->followers ?? 0) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($account->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('accounts.show', $account) }}" class="btn btn-sm btn-info" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('accounts.edit', $account) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('accounts.destroy', $account) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus akun ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Belum ada akun sosial media yang terdaftar</p>
                                        <a href="{{ route('accounts.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Tambah Akun Pertama
                                        </a>
                                    </td>
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
@endsection