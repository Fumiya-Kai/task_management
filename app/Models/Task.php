<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function createTasks($targetId, $taskData)
    {
        $taskData = $this->addDataForNew($targetId, $taskData);
        DB::table('tasks')->insert($taskData);
    }

    public function updateTasks($targetId, $taskData)
    {
        DB::transaction(function () use ($targetId, $taskData) {
            foreach ($taskData as $data) {
                if (!array_key_exists('id', $data)) {
                    $data += array('target_id' => $targetId);
                    $this->fill($data)->save();
                } else {
                    $task = $this->find($data['id']);
                    unset($data['id']);
                    $task->fill($data)->save();
                };
            }
        });
    }

    private function addDataForNew($targetId, $array)
    {
        return array_map(function ($taskData) use ($targetId) {
            return $taskData += array('target_id' => $targetId,
                                      'created_at' => Carbon::now(),
                                      'updated_at' => Carbon::now());
            }, $array);
    }

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
