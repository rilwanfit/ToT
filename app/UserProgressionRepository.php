<?php

namespace App;

use Carbon\Carbon;

class UserProgressionRepository
{
    public function fetchUserProgressionPerWeek()
    {
        return UserProgression::select('*')
        ->orderBy('onboarding_percentage')
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('W');
        });
    }
}
