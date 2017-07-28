<?php

use App\UserProgression\UsersActive;
use Illuminate\Support\Collection;

class UsersActiveTest extends TestCase
{
    private $definition;

    public function setUp()
    {
        $this->definition = [
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
                'max' => 100,
            ],
        ];
    }

    public function testIdentifyStepBasedOnPercentageComplete()
    {
        $percentageComplete = 100;
        $step = (new UsersActive($this->definition))->identifyStepBasedOnPercentageComplete($percentageComplete);
        $this->assertEquals(3, $step);

        $percentageComplete = 0;
        $step = (new UsersActive($this->definition))->identifyStepBasedOnPercentageComplete($percentageComplete);
        $this->assertEquals(1, $step);

        $percentageComplete = 15;
        $step = (new UsersActive($this->definition))->identifyStepBasedOnPercentageComplete($percentageComplete);
        $this->assertEquals(1, $step);

        $percentageComplete = 20;
        $step = (new UsersActive($this->definition))->identifyStepBasedOnPercentageComplete($percentageComplete);
        $this->assertEquals(2, $step);

        $percentageComplete = 39;
        $step = (new UsersActive($this->definition))->identifyStepBasedOnPercentageComplete($percentageComplete);
        $this->assertEquals(2, $step);
    }

    public function CalculateTotalNumberOfUserWhoCompletedTheSteps()
    {
        $usersGroupByPercentageComplete = new Collection(
            [
                0 => new Collection([1, 2, 3]),
                40 => new Collection([1, 2]),
                50 => new Collection([1, 2, 3, 4, 5]),
                100 => new Collection([])
            ]
        );

        $numberOfUsersActiveForSteps = (new UsersActive($this->definition))
            ->calculateTotalPerStep($usersGroupByPercentageComplete);

        $expected = [
            1 => 3,
            2 => 0,
            3 => 7,
            4 => 0,
            5 => 0,
            6 => 0,
            7 => 0,
            8 => 0,
        ];

        $this->assertEquals($expected, $numberOfUsersActiveForSteps);
    }

    public function testCalculateTotalNumberOfUserWhoCompletedTheStepsWithoutOutOfRange()
    {
        $usersGroupByPercentageComplete = new Collection(
            [
                20 => new Collection([1, 2, 3]),
                25 => new Collection([1, 2]),
                30 => new Collection([1, 2, 3, 4, 5]),
                100 => new Collection([])
            ]
        );

        $definition = [
            1 => [
                'min' => 0,
                'max' => 29,
            ],
            [
                'min' => 30,
                'max' => 39,
            ],
            [
                'min' => 40,
                'max' => 100,
            ],
        ];

        $numberOfUsersActiveForSteps = (new UsersActive($definition))
            ->calculateTotalPerStep($usersGroupByPercentageComplete);

        $expected = [
            1 => 5,
            2 => 5,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
            7 => 0,
            8 => 0,
        ];

        $this->assertEquals($expected, $numberOfUsersActiveForSteps);
    }
}
