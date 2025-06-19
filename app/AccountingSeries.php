<?php

namespace App;

trait AccountingSeries
{
    protected function getChartData(): array
    {
        return [
            'data' => [50, 30, 18, 5, 13],
            'labels' => ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Agos','Set','Out','Nov','Dez'],
        ];
   }
 }
