<?php declare(strict_types = 1);

namespace App\HighCharts;


interface ChartSeries
{
    public function getSeriesOptions() : array;
}