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
        $weeks = $endOfMonth->weekNumberInMonth + (int)$this->isSunday($endOfMonth) - (int)$this->isSunday($startOfMonth);
        $calendarData = [
            'year' => $date->year,
            'month' => $date->month,
            'weeks' => $weeks,
            'last' => $date->copy()->subMonthsNoOverflow()->format('Y-m'),
            'next' => $date->copy()->addMonthsNoOverflow()->format('Y-m'),
            'data' => [],
        ];

        $period = CarbonPeriod::create($startOfMonth->format('Y-m-d'), $endOfMonth->format('Y-m-d'));
        $calendarData = $this->paddingStart($calendarData, $startOfMonth);
        $calendarData = $this->createCalendarData($calendarData, $period, null, $startOfMonth);
        $calendarData = $this->paddingEnd($calendarData, $endOfMonth);
        $calendarData = collect($calendarData);

        return $calendarData;
    }

    protected function paddingStart($calendarData, $startOfMonth)
    {
        if ($this->isSunday($startOfMonth)) {
            return $calendarData;
        } else {
            $startDate = $startOfMonth->subDays($startOfMonth->dayOfWeek);
            $period = CarbonPeriod::create($startDate->format('Y-m-d'), $startDate->copy()->endOfMonth()->format('Y-m-d'));
            return $this->createCalendarData($calendarData, $period, 1);
        }
    }

    protected function paddingEnd($calendarData, $endOfMonth)
    {
        if ($endOfMonth->dayOfWeek  === 6) {
            return $calendarData;
        } else {
            $endDate = $endOfMonth->addDays(6 - $endOfMonth->dayOfWeek);
            $period = CarbonPeriod::create($endDate->copy()->startOfMonth()->format('Y-m-d'), $endDate->format('Y-m-d'));
            return $this->createCalendarData($calendarData, $period, $calendarData['weeks']);
        }
    }

    protected function createCalendarData($calendarData, $period, $week = null, $startOfMonth = null)
    {
        if ($week) {
            foreach ($period as $oneDay) {
                $day_of_week = $oneDay->dayOfWeek;
                $day = $oneDay->day;

                $dateArray = [
                    'week' => $week,
                    'day_of_week' => $day_of_week,
                    'day' => $day,
                ];

                $calendarData['data'][] = $dateArray;
            }
        } else {
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
        }

        return $calendarData;
    }

    protected function isSunday($date)
    {
        return $date->dayOfWeek === 0;
    }


}