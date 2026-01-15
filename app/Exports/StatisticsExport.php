<?php

namespace App\Exports;

use App\Models\SocialMediaStatistic;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StatisticsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $query = SocialMediaStatistic::with('account');

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('record_date', [$this->startDate, $this->endDate]);
        }

        return $query->orderBy('record_date', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Platform',
            'Nama Akun',
            'Followers',
            'Following',
            'Posts',
            'Engagement',
            'Engagement Rate (%)'
        ];
    }

    public function map($statistic): array
    {
        return [
            $statistic->record_date->format('d-m-Y'),
            ucfirst($statistic->account->platform),
            $statistic->account->account_name,
            $statistic->followers,
            $statistic->following,
            $statistic->posts_count,
            $statistic->engagement,
            $statistic->engagement_rate
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}