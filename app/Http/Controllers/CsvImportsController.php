<?php

namespace App\Http\Controllers;

use App\UserProgression;
use Carbon\Carbon;

class CsvImportsController extends Controller
{
    public function import()
    {
        if (($handle = fopen ( $this->getFile(), 'r' )) !== false) {
            while ( ($data = fgetcsv ( $handle, 1000, ';' )) !== false ) {
                $userProgression = new UserProgression();
                $userProgression->user_id = $data[0];
                $userProgression->created_at = $data[1];
                $userProgression->onboarding_percentage = (int) $data[2];
                $userProgression->count_applications = (int) $data[3];
                $userProgression->count_accepted_applications = (int) $data[4];
                $userProgression->save ();
            }
            fclose ( $handle );
        }
    }

    private function getFile()
    {
        return storage_path() . '/user_progressions.csv';
    }
}