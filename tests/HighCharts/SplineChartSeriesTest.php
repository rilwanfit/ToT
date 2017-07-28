<?php

use App\HighCharts\ChartSeries;
use App\HighCharts\SplineChartSeries;
use Illuminate\Support\Collection;

class SplineChartSeriesTestTest extends TestCase
{
    private $dataCollection;

    public function setUp()
    {
        $this->dataCollection = \Mockery::mock(Collection::class);
    }

    public function testShouldImplementChartSeries()
    {
        $this->assertInstanceOf(
            ChartSeries::class,
            new SplineChartSeries($this->dataCollection, \App\UserProgression\Definition::STEP_PERCENTAGE_RANGE)
        );
    }
}
