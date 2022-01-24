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

    public function calendar($day = 'now')
    {
        $date = Carbon::create($day);
        $startOfMonth = $date->copy()->startOfMonth();
        $endOfMonth = $date->copy()->endOfMonth();
        $weeks = $date->copy()->endOfMonth()->weekNumberInMonth + (int)$this->isSunday($endOfMonth) - (int)$this->isSunday($startOfMonth);
        $calendarData = [
            'year' => $date->year,
            'month' => $date->month,
            'weeks' => $weeks,
            'last' => $date->copy()->subMonthsNoOverflow()->format('Y-m'),
            'next' => $date->copy()->addMonthsNoOverflow()->format('Y-m'),
            'data' => [],
        ];

        if (!$this->isSunday($startOfMonth)) {
            $calendarData = $this->paddingStart($calendarData, $date);
        }

        $period = CarbonPeriod::create($date->copy()->startOfMonth()->format('Y-m-d'), $date->copy()->endOfMonth()->format('Y-m-d'));

        foreach ($period as $oneDay) {
            $week = $oneDay->weekNumberInMonth + (int)$this->isSunday($oneDay) - (int)$this->isSunday($startOfMonth);
            $day_of_week = $oneDay->dayOfWeek;
            $day = $oneDay->day;

            $dateArray = [
                'week' => $week,
                'day_of_week' => $day_of_week,
                'day' => $day,
            ];

            $calendarData['data'][] = $dateArray;
        }

        if ($date->copy()->endOfMonth()->dayOfWeek  !== 6) {
            $calendarData = $this->paddingEnd($calendarData, $date);
        }

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
        $endDate = $date->copy()->endOfMonth()->addDays(6 - $date->copy()->endOfMonth()->dayOfWeek);
        $period = CarbonPeriod::create($endDate->copy()->startOfMonth()->format('Y-m-d'), $endDate->format('Y-m-d'));

        foreach ($period as $oneDay) {
            $day_of_week = $oneDay->dayOfWeek;
            $day = $oneDay->day;

            $dateArray = [
                'week' => $calendarData['weeks'],
                'day_of_week' => $day_of_week,
                'day' => $day,
            ];

            $calendarData['data'][] = $dateArray;
        }

        return $calendarData;
    }

    protected function isSunday($date)
    {
        return $date->dayOfWeek === 0;
    }

}