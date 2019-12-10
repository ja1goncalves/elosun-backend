<?php


namespace App;


use Carbon\Carbon;

class Util
{
    public static function getIntervalDate($interval)
    {
        switch ($interval){
            case 1: return [Carbon::today(), Carbon::tomorrow()];
            case 7: return [Carbon::today()->previousWeekday(), Carbon::today()->nextWeekday()];
            case 30: return [ Carbon::today()->firstOfMonth(), Carbon::today()->lastOfMonth()];
            default: return [Carbon::today()->subDays($interval), Carbon::today()];
        }
    }
}
