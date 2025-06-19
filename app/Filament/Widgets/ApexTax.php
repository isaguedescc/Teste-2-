<?php

namespace App\Filament\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class ApexTax extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'apexTax';
    
    
    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Tax';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $data = \App\Models\Tax::selectRaw("strftime('%m', due_date) as month, SUM(value) as total")
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('total', 'month')
        ->toArray();

    $months = array_map(function($monthNumber) {
        return date('M', mktime(0, 0, 0, (int)$monthNumber, 10));
    }, array_keys($data));

    $totals = array_values($data);

    return [
        'chart' => [
            'type' => 'bar',
            'height' => 300,
        ],
        'series' => [
            [
                'name' => 'Valor de Impostos Mensal',
                'data' => $totals,
            ],
        ],
        'xaxis' => [
            'categories' => $months,
            'labels' => [
                'style' => [
                    'fontFamily' => 'inherit',
                ],
            ],
        ],
        'yaxis' => [
            'labels' => [
                'style' => [
                    'fontFamily' => 'inherit',
                ],
            ],
        ],
        'colors' => ['#ef4444'],
    ];
    }
}
