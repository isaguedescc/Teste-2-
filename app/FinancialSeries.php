<?php

namespace App;

use App\Models\Financial;
use Carbon\Carbon;

trait FinancialSeries
{
    public function getFinancialDataForChart(): array
    {
        $financials = Financial::query()
            ->orderBy('competence_month')
            ->get()
            ->groupBy(function ($item) {
                return Carbon::parse($item->competence_month)->format('Y-m');
            })
            ->map(function ($monthFinancials) {
                return $monthFinancials->sum('value');
            });
        $labels = $financials->keys()->toArray();
        $values = $financials->values()->toArray();
        return compact('labels', 'values');
    }
}
