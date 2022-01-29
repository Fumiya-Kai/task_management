<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'task',
        'target_id',
        'start',
        'end_schedule',
        'end',
        'order'
    ];

    public function getStartTasks($date)
    {
        return $this->whereDate('start', '=', $date)
                    ->get();
    }

    public function getTasksInProgress($date)
    {
        return $this->whereDate('start', '<=', $date)
                    ->whereDate('end_schedule', '>=', $date)
                    ->get();
    }

    public function getCompletedTasks($date)
    {
        return $this->whereDate('end_schedule', '=', $date)
                    ->get();
    }

    public function getTargetGroup()
    {
        return $this->groupBy('target_id')
                    ->get('target_id');
    }

    public function countStartTasks($date)
    {
        return $this->whereDate('start', '=', $date->format('Y-m-d'))
                    ->count();
    }

    public function countTasksInProgress($date)
    {
        return $this->whereDate('start', '<=', $date->format('Y-m-d'))
                    ->whereDate('end_schedule', '>=', $date->format('Y-m-d'))
                    ->count();
    }

    public function countCompletedTasks($date)
    {
        return $this->whereDate('end_schedule', '=', $date->format('Y-m-d'))
                    ->count();
    }

    public function target()
    {
        return $this->belongsTo(Target::class, 'target_id');
    }
}
