<?php

namespace App;

trait TaxSeries
{
    public function getTaxSeriesData(): array
    {
        $data = \App\Models\Tax::query()
            ->selectRaw("DATE_FORMAT(due_date, '%Y-%m') as month, SUM(value) as total")
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        $months = [];
        $totals = [];
        foreach ($data as $item) {
            $months[] = \Carbon\Carbon::createFromFormat('Y-m', $item->month)->format('M Y');
            $totals[] = $item->total;
        }
        // Ensure all months of the current year are included, even if no data
        $currentYear = \Carbon\Carbon::now()->year;
        $allMonths = [];
        for ($i = 1; $i <= 12; $i++) {
            $allMonths[] = \Carbon\Carbon::createFromDate($currentYear, $i, 1)->format('M Y');
        }
        $combinedData = array_combine($months, $totals);
        $months = $allMonths;
        $totals = array_map(function ($month) use ($combinedData) {
            return $combinedData[$month] ?? 0;
        }, $allMonths);
        return ['months' => $months, 'totals' => $totals];
    }
}
