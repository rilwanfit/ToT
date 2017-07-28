<?php declare(strict_types = 1);

namespace App\UserProgression;

use Illuminate\Support\Collection;

class UsersActive
{
    private $definition;

    function __construct(array $definition)
    {
        $this->definition = $definition;
    }

    public function calculateTotalPerStep(Collection $usersGroupByPercentageComplete) : array
    {
        $numberUsersForSteps = [];
        foreach ($usersGroupByPercentageComplete as $percentageComplete => $users) {
            $step = $this->identifyStepBasedOnPercentageComplete($percentageComplete);

            $count = $users->count();
            if (isset($numberUsersForSteps[$step])) {
                $numberUsersForSteps[$step] += $count;
            } else {
                $numberUsersForSteps[$step] = $count;
            }
        }
        $numberUsersForSteps = $numberUsersForSteps + [1 => 0, 0, 0, 0, 0, 0, 0, 0];
        ksort($numberUsersForSteps);
        return $numberUsersForSteps;
    }

    public function identifyStepBasedOnPercentageComplete($percentageComplete)
    {
        foreach ($this->definition as $step => $item) {
            if ($this->betweenRageMinAndMaxRange($percentageComplete, $item)) {
                return $step;
            }
        }
    }

    private function betweenRageMinAndMaxRange($userPercentage, $item) : bool
    {
        return ($item['min'] <= $userPercentage) && ($userPercentage <= $item['max']);
    }
}