<?php

namespace App\Filament\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class ApexFinancial extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'apexFinancial';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'ApexFinancial';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getData(): array
    {
        $data = $this->getFinancialData(); // Obtém os dados preparados

        return [
            'datasets' => [
                [
                    'label' => 'Valor Total',
                    'data' => $data['values'],
                    'borderColor' => '#36a2eb', // Cor da linha (exemplo: azul)
                    'tension' => 0.1, // Curva da linha (opcional)
                ],
            ],
            'labels' => $data['labels'],
        ];
    }

    protected function getOptions(): array
    {
        return [
            'chart' => [
                'type' => 'line',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'ApexFinancial',
                    'data' => [2, 4, 6, 10, 14, 7, 2, 9, 10, 15, 13, 18],
                ],
            ],
            'xaxis' => [
                'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
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
            'colors' => ['#8AB364'],
            'stroke' => [
                'curve' => 'smooth',
            ],
        ];
    }

    public function getFinancialData(): array
{
    {
        $financials = Financial::query()
          // ->where('company_id', auth()->user()->company_id)
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

        return [
            'labels' => $labels,
            'values' => $values,
        ];
    }
}
}
   
