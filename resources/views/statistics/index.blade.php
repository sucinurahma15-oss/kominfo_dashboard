@extends('layouts.app')

@section('content')
<div class="container-fluid">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-database me-2"></i>Data Statistik Sosial Media
        </h1>
        <a href="{{ route('statistics.create') }}" class="btn btn-success shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50 me-1"></i> Input Statistik
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Statistik</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" width="100%" cellspacing="0">
                            <thead class="table-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Akun</th>
                                    <th>Platform</th>
                                    <th>Followers</th>
                                    <th>Following</th>
                                    <th>Posts</th>
                                    <th>Engagement</th>
                                    <th>Rate</th>
                                    <th class="text-center" style="width: 100px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($statistics as $stat)
                                    <tr>
                                        <td class="align-middle">{{ $stat->record_date->format('d M Y') }}</td>
                                        <td class="align-middle fw-bold">{{ $stat->account->account_name }}</td>
                                        <td class="align-middle">
                                            <span class="badge bg-secondary">
                                                <i class="fab fa-{{ $stat->account->platform }} me-1"></i>
                                                <span class="text-capitalize">{{ $stat->account->platform }}</span>
                                            </span>
                                        </td>
                                        <td class="align-middle">{{ number_format($stat->followers) }}</td>
                                        <td class="align-middle">{{ number_format($stat->following) }}</td>
                                        <td class="align-middle">{{ number_format($stat->posts_count) }}</td>
                                        <td class="align-middle">{{ number_format($stat->engagement) }}</td>
                                        <td class="align-middle">{{ number_format($stat->engagement_rate, 2) }}%</td>
                                        
                                        <td class="align-middle text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('statistics.edit', $stat) }}" class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('statistics.destroy', $stat) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                                        <td colspan="9" class="text-center py-5">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                                <p class="text-muted fw-bold">Belum ada data statistik</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-3 d-flex justify-content-end">
                        {{ $statistics->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection