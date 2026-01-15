<?php

namespace App\Http\Controllers;

use App\Exports\StatisticsExport;
use App\Models\SocialMediaStatistic;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ExportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function exportExcel(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $filename = 'statistik-sosmed-' . date('Y-m-d') . '.xlsx';

        return Excel::download(
            new StatisticsExport($startDate, $endDate), 
            $filename
        );
    }

    public function exportPdf(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = SocialMediaStatistic::with('account');

        if ($startDate && $endDate) {
            $query->whereBetween('record_date', [$startDate, $endDate]);
        }

        $statistics = $query->orderBy('record_date', 'desc')->get();

        // Calculate summary statistics (Bagian baru yang ditambahkan)
        $summary = [
            'total_followers' => $statistics->sum('followers'),
            'total_engagement' => $statistics->sum('engagement'),
            'total_posts' => $statistics->sum('posts_count'),
            'avg_engagement_rate' => $statistics->avg('engagement_rate'),
            'total_records' => $statistics->count()
        ];

        $pdf = Pdf::loadView('exports.statistics-pdf', [
            'statistics' => $statistics,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'generatedAt' => Carbon::now(),
            'summary' => $summary // Passing variable summary ke view
        ]);

        // Set paper size and orientation (Bagian baru yang ditambahkan)
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('Laporan-Statistik-Sosmed-' . date('Y-m-d') . '.pdf');
    }

    public function showExportForm()
    {
        return view('exports.form');
    }
}