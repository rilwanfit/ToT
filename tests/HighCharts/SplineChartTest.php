<?php

use App\HighCharts\ChartOptions;
use App\HighCharts\SplineChart;
use App\HighCharts\SplineChartSeries;
use Illuminate\Support\Collection;

class SplineChartTest extends TestCase
{
    private $dataCollection;

    public function setUp()
    {
        $this->dataCollection = \Mockery::mock(SplineChartSeries::class);
    }

    public function testShouldImplementChartOptions()
    {
        $this->assertInstanceOf(ChartOptions::class, new SplineChart($this->dataCollection));
    }

    public function testArrangeStepsBasedOnPercentageComplete()
    {
        $definition = [
            1 => [
                'min' => 0,
                'max' => 19,
            ],
            [
                'min' => 20,
                'max' => 39,
            ],
            [
                'min' => 40,
                'max' => 49,
            ],
        ];

        $splineChartSeries = new SplineChartSeries(new Collection(), $definition);

        $this->assertEquals([], $splineChartSeries->prepareSeriesData([], 0));

        $numberOfUsersPerStep = [
            1 => 1,
            2 => 1,
            3 => 1,
            4 => 1,
        ];
        $results = $splineChartSeries->prepareSeriesData($numberOfUsersPerStep,4);

        $this->assertEquals([ 100.0, 75.0, 50.0, 25.0], $results);
    }

    public function testSplineChartOptionShouldReturnChartTypeSpline()
    {
        $this->dataCollection->shouldReceive('getSeriesOptions')
            ->once()
            ->andReturn([]);

        $options = (new SplineChart($this->dataCollection))->getOptions();

        $this->assertEquals($options['chart']['type'], 'spline');
    }
}
