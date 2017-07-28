<?php declare(strict_types = 1);

namespace App\HighCharts;

use App\UserProgression\UsersActive;
use App\UserProgression\UsersCompleted;
use Illuminate\Support\Collection;

class SplineChartSeries implements ChartSeries
{
    private $userProgressionDetails;
    private $definition;

    function __construct(Collection $userProgressionDetails, array $definition)
    {
        $this->userProgressionDetails = $userProgressionDetails;
        $this->definition = $definition;
    }

    public function getSeriesOptions() : array
    {
        $series = [];

        foreach ($this->userProgressionDetails as $item) {
            $totalNumberOfUsers = $item->count();
            $usersGroupByPercentageComplete = $item->groupBy('onboarding_percentage');
            $numberOfActiveUsersForSteps = (new UsersActive($this->definition))->calculateTotalPerStep($usersGroupByPercentageComplete);

            $series[] = [
                'name' => $item->first()->created_at,
                'data' => $this->prepareSeriesData($numberOfActiveUsersForSteps, $totalNumberOfUsers)
            ];
        }

        return $series;
    }

    public function prepareSeriesData(array $stepsWithNumberOfUsers, int $totalNumberOfUsers)
    {
        $usersCompleted = new UsersCompleted();
        $numberOfUsersCompletedForSteps = $usersCompleted->calculateTotalPerStep($stepsWithNumberOfUsers, $totalNumberOfUsers);

        $seriesData = $usersCompleted->calculatePercentagePerStep($numberOfUsersCompletedForSteps, $totalNumberOfUsers);

        return array_values($seriesData);
    }
}
