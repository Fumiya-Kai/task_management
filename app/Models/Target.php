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
            $task = new Task();
            $task->createTasks($this->id, $input['taskData']);
        });
    }

    public function updateTarget($targetId, $targetData)
    {
        $this->find($targetId)
             ->fill($targetData)
             ->save();
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'target_id');
    }

}
