<?php

namespace App\Http\Controllers;

use App\Calendar\CreateCalendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $day = $request->input('day');
        $calendar = new CreateCalendar;
        $calendarData = $calendar->calendar($day);

        return view('calendar.calendar', compact('calendarData'));
    }
}
