<?php


class UsersCompletedTest extends TestCase
{
    public function testCalculateTotalNumberOfUserWhoCompletedTheSteps()
    {
        $stepsWithNumberOfUsers = [
            1 => 1,
            2 => 1,
            3 => 2,
            4 => 0,
        ];
        $totalNumberOfUsers = 4;

        $numberOfUsersCompletedForSteps = (new \App\UserProgression\UsersCompleted())
            ->calculateTotalPerStep($stepsWithNumberOfUsers, $totalNumberOfUsers);

        $expected = [
            1 => 4,
            2 => 3,
            3 => 2,
            4 => 0,
        ];

        $this->assertEquals($expected, $numberOfUsersCompletedForSteps);
    }

    public function testCalculateTotalNumberOfUsersPercentageWhoCompletedTheSteps()
    {
        $stepsWithNumberOfUsersCompleted = [
            1 => 4,
            2 => 3,
            3 => 2,
            4 => 0,
        ];
        $totalNumberOfUsers = 4;

        $numberOfUsersPercentageForSteps = (new \App\UserProgression\UsersCompleted())
            ->calculatePercentagePerStep($stepsWithNumberOfUsersCompleted, $totalNumberOfUsers);

        $expected = [
            1 => 100.0,
            2 => 75.0,
            3 => 50.0,
            4 => 0,
        ];

        $this->assertEquals($expected, $numberOfUsersPercentageForSteps);
    }
}
