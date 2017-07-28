<?php declare(strict_types = 1);

namespace App\UserProgression;

class UsersCompleted
{
    public function calculateTotalPerStep($stepsWithNumberOfUsers, $totalNumberOfUsers) : array
    {
        $numberOfUsersCompletedForSteps = [];
        $tempCount = 0;
        foreach ($stepsWithNumberOfUsers as $step => $numberOfUsersForStep) {
            if ($step == 1) {
                $numberOfUsersCompletedForSteps[$step] = $totalNumberOfUsers;
            } else {
                $numberOfUsersCompletedForSteps[$step] = ($totalNumberOfUsers - $tempCount);
            }
            $tempCount += $numberOfUsersForStep;
        }

        return $numberOfUsersCompletedForSteps;
    }

    public function calculatePercentagePerStep($numberOfUsersCompleted, $totalNumberOfUsers) : array
    {
        $results = [];
        foreach ($numberOfUsersCompleted as $step => $numberOfUsersCompletedForStep) {
            $results[$step] = round(($numberOfUsersCompletedForStep / $totalNumberOfUsers) * 100);
        }

        return $results;
    }
}