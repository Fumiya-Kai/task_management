<?php

namespace App\Http\Controllers;

use App\Calendar\CreateCalendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $calendar = new CreateCalendar;
        $calendarData = $calendar->calendar();

        return view('calendar.calendar', compact('calendarData'));
    }
}
