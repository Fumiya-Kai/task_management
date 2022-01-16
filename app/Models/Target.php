<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Target extends Model
{
    const DATA_PER_PAGE = 10;

    protected $fillable = [
        'title',
        'content',
        'start',
        'end_schedule',
        'end'
    ];

    public function getData()
    {
        return $this->paginate(self::DATA_PER_PAGE);
    }

    public function createTarget($input)
    {
        DB::transaction(function () use ($input) {
            $this->fill($input['targetData'])->save();
            $input['taskData'] = $this->addDataForNew($this->id, $input['taskData']);
            DB::table('tasks')->insert($input['taskData']);
        });
    }

    public function updateTarget($targetId, $input)
    {
        DB::transaction(function () use ($targetId, $input) {
            $this->find($targetId)->fill($input['targetData'])->save();
            $input['taskData'] = $this->addDataForUpdate($input['taskData']);
            $count =1;
            foreach ($input['taskData'] as $taskData) {
                if (!array_key_exists('id', $taskData)) {
                    $taskData += array('target_id' => $targetId,
                                      'created_at' => Carbon::now(),
                                      'updated_at' => Carbon::now());
                    print_r('a');
                    print_r($count);
                    $task = new Task();
                    $task->fill($taskData)->save();
                    $count += 1;
                } else {
                    print_r('a');
                    print_r($count);
                    $task = Task::find($taskData['id']);
                    unset($taskData['id']);
                    $task->fill($taskData)->save();
                    $count += 1;
                };
            }
        });
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'target_id');
    }

    private function addDataForNew($targetId, $array)
    {
        return array_map(function ($taskData) use ($targetId) {
            return $taskData += array('target_id' => $targetId,
                                      'created_at' => Carbon::now(),
                                      'updated_at' => Carbon::now());
            }, $array);
    }

    private function addDataForUpdate($array)
    {
        return array_map(function ($taskData) {
            return $taskData += array('updated_at' => Carbon::now());
            }, $array);
    }


}
