<?php declare(strict_types = 1);

namespace App\HighCharts;

use App\HighCharts;
use Illuminate\Support\Facades\Facade as FacadeClass;

class Facade extends FacadeClass
{
    public static function getFacadeAccessor()
    {
        return HighCharts::class;
    }
}