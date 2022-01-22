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

        $period = CarbonPeriod::create($date->startOfMonth()->format('Y-m-d'), $date->endOfMonth()->format('Y-m-d'));

        foreach ($period as $oneDay) {
            $week = ($oneDay->dayOfWeek === 0)? $oneDay->weekNumberInMonth + 1 : $oneDay->weekNumberInMonth;
            $day_of_week = $oneDay->dayOfWeek;
            $day = $oneDay->day;

            $dateArray = [
                'week' => $week,
                'day_of_week' => $day_of_week,
                'day' => $day,
            ];

            $calendarData['data'][] = $dateArray;
        }

        $calendarData = collect($calendarData);

        return $calendarData;
    }

}