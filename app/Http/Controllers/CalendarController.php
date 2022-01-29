<?php

namespace App\Http\Controllers;

use App\Calendar\CreateCalendar;
use App\Models\Task;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    private $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }
    public function index(Request $request)
    {
        $day = $request->input('day');
        $calendar = new CreateCalendar;
        $calendarData = $calendar->calendar($day);

        return view('calendar.calendar', compact('calendarData'));
    }

    public function show($date)
    {
        $startTasks = $this->task->getStartTasks($date);
        $inProgressTasks = $this->task->getTasksInProgress($date);
        $endTasks = $this->task->getCompletedTasks($date);
        $allTasks = $startTasks->merge($inProgressTasks)->merge($endTasks);
        $targetGroup = $this->task->getTargetGroup();
        return view('calendar.show', compact('date', 'startTasks', 'inProgressTasks', 'endTasks', 'allTasks', 'targetGroup'));
    }

}
