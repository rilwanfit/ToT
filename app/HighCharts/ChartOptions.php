<?php declare(strict_types = 1);

namespace App\HighCharts;

interface ChartOptions
{
    public function getOptions() : array;
}