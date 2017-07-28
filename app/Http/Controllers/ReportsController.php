<?php

namespace App\Http\Controllers;

use App\HighCharts\SplineChart;
use App\HighCharts\SplineChartSeries;
use App\UserProgression\Definition;
use App\UserProgressionRepository;

class ReportsController extends Controller
{
    public function weekly()
    {
        $userProgression = (new UserProgressionRepository())->fetchUserProgressionPerWeek();

        $charts = (new SplineChart(
            new SplineChartSeries($userProgression, Definition::STEP_PERCENTAGE_RANGE)
        ))->getOptions();

        // Return Json
        return $charts;

        // Render the chart.
        // echo HighChartsFacade::display("id-highchart", $charts);
    }
}