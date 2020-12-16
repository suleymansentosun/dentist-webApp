<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateAndDataMatcher
{
    public $dateRelatedDatas;

    public function getPreviousDays($fromTime, $countOfDateToGoPrevious)
    {
        $startOfPeriod = $fromTime->copy()->subDays($countOfDateToGoPrevious + 1);
        $periodDays = array();

        for ($i = 0; $i <= $countOfDateToGoPrevious; $i++) {
            $periodDays[] = $startOfPeriod->addDay()->copy()->format('Y, m, d');
        }

        return $periodDays;
    }

    public function getNextDays($day, $countOfDayToGoNext)
    {        
        $periodDays = array();

        for ($i = 0; $i <= $countOfDayToGoNext; $i++) {
            $periodDays[] = $day->copy()->addDay($i)->format('Y, m, d');
        }        

        return $periodDays;
    }

    public function getPreviousWeeks($fromTime, $countOfDateToGoPrevious)
    {
        $startOfPeriod = $fromTime->copy()->subWeeks($countOfDateToGoPrevious + 1)->startOfWeek();
        $periodWeeks = array();

        for ($i = 0; $i <= $countOfDateToGoPrevious; $i++) {
            $periodWeeks[] = $startOfPeriod->addWeek()->copy()->format('Y, m, d');
        }

        return $periodWeeks;
    }
    
    public function getPreviousMonths($fromTime, $countOfDateToGoPrevious)
    {
        $startOfPeriod = $fromTime->copy()->startOfMonth()->subMonthsNoOverflow($countOfDateToGoPrevious + 1);
        $periodMonths = array();

        for ($i = 0; $i <= $countOfDateToGoPrevious; $i++) {
            $periodMonths[] = $startOfPeriod->addMonthNoOverflow()->copy()->format('Y, m, d');
        }

        return $periodMonths;
    }

    public function combineDatesAndDatas($previousDates)
    {
        $combinedDatesAndDatas = array();

        $combinedDateAndData = array();

        for ($i = 0; $i <= count($previousDates)-1; $i++) {            
            array_push($combinedDateAndData, $previousDates[$i]);
            
            foreach ($this->dateRelatedDatas[$i] as $data) {
                array_push($combinedDateAndData, $data);
            }

            array_push($combinedDatesAndDatas, $combinedDateAndData);

            $combinedDateAndData = [];
        }

        return $combinedDatesAndDatas;
    }
}