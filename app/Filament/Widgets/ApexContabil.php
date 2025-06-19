<?php

namespace App\Filament\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class ApexContabil extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'apexAcconting';
    

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Contábil';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $data = \App\Models\Accounting::selectRaw("strftime('%m', date) as month, SUM(amount) as total")
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
            'type' => 'column',
            'height' => 300,
        ],
        'series' => [
            [
                'name' => 'Valor de Entrada Mensal',
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
        'colors' => ['#10b981'],
    ];
    }
}
