<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Statistik Sosial Media</title>
    <style>
        @page {
            margin: 15mm;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #333;
            line-height: 1.4;
        }

        /* Header */
        .header {
            text-align: center;
            padding-bottom: 15px;
            margin-bottom: 20px;
            border-bottom: 3px solid #004B9D;
        }

        .header h1 {
            font-size: 18px;
            color: #004B9D;
            margin-bottom: 5px;
        }

        .header h2 {
            font-size: 14px;
            color: #0066CC;
            font-weight: normal;
            margin-bottom: 3px;
        }

        .header p {
            font-size: 10px;
            color: #666;
        }

        /* Info Box */
        .info-box {
            background: #f5f5f5;
            padding: 12px;
            margin-bottom: 20px;
            border-left: 4px solid #004B9D;
        }

        .info-box table {
            width: 100%;
        }

        .info-box td {
            padding: 3px 0;
            font-size: 10px;
        }

        .info-box td:first-child {
            font-weight: bold;
            width: 30%;
            color: #004B9D;
        }

        /* Summary */
        .summary {
            margin-bottom: 20px;
        }

        .summary-title {
            background: #004B9D;
            color: white;
            padding: 8px 10px;
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .summary-grid {
            display: table;
            width: 100%;
            margin-bottom: 15px;
        }

        .summary-item {
            display: table-cell;
            width: 25%;
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
            background: white;
        }

        .summary-value {
            font-size: 18px;
            font-weight: bold;
            color: #004B9D;
            margin-bottom: 3px;
        }

        .summary-label {
            font-size: 9px;
            color: #666;
            text-transform: uppercase;
        }

        /* Table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .data-table thead {
            background: #004B9D;
            color: white;
        }

        .data-table th {
            padding: 8px 5px;
            text-align: left;
            font-size: 10px;
            font-weight: bold;
        }

        .data-table td {
            padding: 6px 5px;
            border-bottom: 1px solid #ddd;
            font-size: 10px;
        }

        .data-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .platform {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 3px;
            font-size: 9px;
            color: white;
            font-weight: bold;
        }

        .facebook { background: #3b5998; }
        .instagram { background: #E1306C; }
        .twitter { background: #1DA1F2; }
        .youtube { background: #FF0000; }
        .tiktok { background: #000; }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        /* Footer */
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 2px solid #004B9D;
        }

        .signature {
            display: table;
            width: 100%;
            margin-top: 40px;
        }

        .signature-left,
        .signature-right {
            display: table-cell;
            width: 50%;
            text-align: center;
            vertical-align: top;
        }

        .signature-line {
            margin-top: 60px;
            font-weight: bold;
            padding-top: 2px;
            border-top: 1px solid #333;
            display: inline-block;
            width: 150px;
        }

        .signature-nip {
            font-size: 9px;
            color: #666;
            margin-top: 3px;
        }

        .doc-info {
            text-align: center;
            font-size: 9px;
            color: #999;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>DINAS KOMUNIKASI DAN INFORMATIKA</h1>
        <h2>KOTA BINJAI</h2>
        <p>Jl. Gatot Subroto No. 1, Binjai, Sumatera Utara | Telp: (061) 8821293</p>
    </div>

    <!-- Info Box -->
    <div class="info-box">
        <table>
            <tr>
                <td>Judul Laporan</td>
                <td>: Statistik Media Sosial</td>
            </tr>
            <tr>
                <td>Periode</td>
                <td>: 
                    @if($startDate && $endDate)
                        {{ \Carbon\Carbon::parse($startDate)->format('d F Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}
                    @else
                        Semua Data
                    @endif
                </td>
            </tr>
            <tr>
                <td>Total Data</td>
                <td>: {{ $statistics->count() }} record</td>
            </tr>
            <tr>
                <td>Dicetak</td>
                <td>: {{ $generatedAt->format('d F Y, H:i') }} WIB</td>
            </tr>
        </table>
    </div>

    <!-- Summary -->
    <div class="summary">
        <div class="summary-title">RINGKASAN STATISTIK</div>
        <div class="summary-grid">
            <div class="summary-item">
                <div class="summary-value">{{ number_format($statistics->sum('followers')) }}</div>
                <div class="summary-label">Total Followers</div>
            </div>
            <div class="summary-item">
                <div class="summary-value">{{ number_format($statistics->sum('engagement')) }}</div>
                <div class="summary-label">Total Engagement</div>
            </div>
            <div class="summary-item">
                <div class="summary-value">{{ number_format($statistics->sum('posts_count')) }}</div>
                <div class="summary-label">Total Posts</div>
            </div>
            <div class="summary-item">
                <div class="summary-value">{{ number_format($statistics->avg('engagement_rate'), 2) }}%</div>
                <div class="summary-label">Avg Engagement</div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="summary-title">DATA STATISTIK DETAIL</div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="12%">Tanggal</th>
                <th width="15%">Platform</th>
                <th width="23%">Nama Akun</th>
                <th width="11%" class="text-right">Followers</th>
                <th width="11%" class="text-right">Following</th>
                <th width="11%" class="text-right">Posts</th>
                <th width="12%" class="text-right">Engagement</th>
            </tr>
        </thead>
        <tbody>
            @foreach($statistics as $index => $stat)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $stat->record_date->format('d/m/Y') }}</td>
                <td>
                    <span class="platform {{ $stat->account->platform }}">
                        {{ strtoupper($stat->account->platform) }}
                    </span>
                </td>
                <td>{{ $stat->account->account_name }}</td>
                <td class="text-right">{{ number_format($stat->followers) }}</td>
                <td class="text-right">{{ number_format($stat->following) }}</td>
                <td class="text-right">{{ number_format($stat->posts_count) }}</td>
                <td class="text-right">
                    {{ number_format($stat->engagement) }}
                    <small style="color: #999;">({{ number_format($stat->engagement_rate, 1) }}%)</small>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <div class="signature">
            <div class="signature-left">
                <p>Mengetahui,</p>
                <p style="font-weight: bold;">Kepala Dinas</p>
                <p class="signature-line">___________________</p>
                <p class="signature-nip">NIP. ___________________</p>
            </div>
            <div class="signature-right">
                <p>Binjai, {{ $generatedAt->format('d F Y') }}</p>
                <p style="font-weight: bold;">Petugas</p>
                <p class="signature-line">___________________</p>
                <p class="signature-nip">NIP. ___________________</p>
            </div>
        </div>

        <div class="doc-info">
            Dokumen ini digenerate otomatis oleh Sistem Dashboard Statistik Sosial Media<br>
            Diskominfo Kota Binjai &copy; {{ date('Y') }}
        </div>
    </div>
</body>
</html>