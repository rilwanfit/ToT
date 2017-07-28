<?php declare(strict_types = 1);

namespace App\UserProgression;

class Definition
{
    const STEP_PERCENTAGE_RANGE = [
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
        [
            'min' => 50,
            'max' => 69,
        ],
        [
            'min' => 70,
            'max' => 89,
        ],
        [
            'min' => 90,
            'max' => 98,
        ],
        [
            'min' => 99,
            'max' => 99,
        ],
        [
            'min' => 100,
            'max' => 100,
        ],
    ];
}