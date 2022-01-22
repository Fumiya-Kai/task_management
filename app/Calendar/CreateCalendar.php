<?php

namespace App\Calendar;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

class CreateCalendar {

    // // データ形式
    // { month: *
    //   weeks: *
    //   data: {
    //      {
    //        week: 1,
    //        day_of_week: mon,
    //        day: *,
    //      },
    //      {
    //        week: 1,
    //        day_of_week: tue,
    //        day: *,
    //      },
    //      ...
    //    }
    // };

    public function calendar($day = null)
    {
        $date = Carbon::now();
        $calendarData = [
            'month' => $date->month,
            'weeks' => $date->endOfMonth()->weekNumberInMonth,
            'data' => [],
        ];

        $period = CarbonPeriod::create($date->startOfMonth(), $date->endOfMonth());

        foreach ($period as $oneDay) {
            $week = $oneDay->weekNumberInMonth;
            $day_of_week = strtolower($oneDay->format('D'));
            $day = $oneDay->day;

            $dateArray = [
                'week' => $week,
                'day_of_week' => $day_of_week,
                'day' => $day,
            ];

            $calendarData['data'][] = $dateArray;
        }

        return $calendarData;
    }

}