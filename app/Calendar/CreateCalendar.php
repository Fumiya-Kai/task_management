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
            'year' => $date->year,
            'month' => $date->month,
            'weeks' => $date->endOfMonth()->weekNumberInMonth,
            'data' => [],
        ];

        $calendarData = $this->paddingStart($calendarData, $date);

        $period = CarbonPeriod::create($date->copy()->startOfMonth()->format('Y-m-d'), $date->copy()->endOfMonth()->format('Y-m-d'));

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

        $calendarData = $this->paddingEnd($calendarData, $date);

        $calendarData = collect($calendarData);

        return $calendarData;
    }

    protected function paddingStart($calendarData, $date)
    {
        $startDate = $date->copy()->startOfMonth()->subDays($date->startOfMonth()->dayOfWeek);
        $period = CarbonPeriod::create($startDate->format('Y-m-d'), $startDate->copy()->endOfMonth()->format('Y-m-d'));

        foreach ($period as $oneDay) {
            $day_of_week = $oneDay->dayOfWeek;
            $day = $oneDay->day;

            $dateArray = [
                'week' => 1,
                'day_of_week' => $day_of_week,
                'day' => $day,
            ];

            $calendarData['data'][] = $dateArray;
        }

        return $calendarData;
    }

    protected function paddingEnd($calendarData, $date)
    {
        $endDate = $date->copy()->endOfMonth()->addDays(6 - $date->endOfMonth()->dayOfWeek);
        $period = CarbonPeriod::create($endDate->copy()->startOfMonth()->format('Y-m-d'), $endDate->format('Y-m-d'));

        foreach ($period as $oneDay) {
            $day_of_week = $oneDay->dayOfWeek;
            $day = $oneDay->day;

            $dateArray = [
                'week' => $date->endOfMonth()->weekNumberInMonth,
                'day_of_week' => $day_of_week,
                'day' => $day,
            ];

            $calendarData['data'][] = $dateArray;
        }

        return $calendarData;
    }

}