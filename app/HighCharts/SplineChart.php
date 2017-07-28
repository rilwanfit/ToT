<?php declare(strict_types = 1);

namespace App\HighCharts;

class SplineChart implements ChartOptions
{
    private $repository;

    function __construct(SplineChartSeries $repository)
    {
        $this->repository = $repository;
    }

    public function getOptions(): array
    {
        return [
            'chart' => [
                'type' => 'spline',
                'renderTo' => 'chart'
            ],
            'title' => ['text' => 'weekly retention curve'],
            'xAxis' => [
                'categories' => ['step 1', 'step 2', 'step 3', 'step 4', 'step 5', 'step 6', 'step 7', 'step 8'],
            ],
            'yAxis' => [
                'title' => [
                    'text' => 'The percentage of users who made it to that step'
                ],
                'max' => 100,
                'min' => 0,
            ],
            'series' => $this->repository->getSeriesOptions(),
        ];
    }
}