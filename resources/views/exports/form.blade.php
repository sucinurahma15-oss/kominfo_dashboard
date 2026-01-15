@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-file-export"></i> Export Data Statistik
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Export Data</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-download"></i> Pilih Format Export</h5>
                </div>
                <div class="card-body">
                    <form id="exportForm">
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="start_date" name="start_date">
                            <small class="form-text text-muted">Kosongkan untuk export semua data</small>
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="form-label">Tanggal Akhir</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-success btn-lg" onclick="exportExcel()">
                                <i class="fas fa-file-excel"></i> Export ke Excel
                            </button>
                            <button type="button" class="btn btn-danger btn-lg" onclick="exportPdf()">
                                <i class="fas fa-file-pdf"></i> Export ke PDF
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
    function exportExcel() {
        const startDate = document.getElementById('start_date').value;
        const endDate = document.getElementById('end_date').value;
        
        let url = '{{ route("export.excel") }}?';
        if (startDate) url += 'start_date=' + startDate + '&';
        if (endDate) url += 'end_date=' + endDate;
        
        window.location.href = url;
    }

    function exportPdf() {
        const startDate = document.getElementById('start_date').value;
        const endDate = document.getElementById('end_date').value;
        
        let url = '{{ route("export.pdf") }}?';
        if (startDate) url += 'start_date=' + startDate + '&';
        if (endDate) url += 'end_date=' + endDate;
        
        window.location.href = url;
    }
</script>
@endpush
@endsection