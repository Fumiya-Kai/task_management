<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function update($taskId, Request $request)
    {
        $input = $request->all();
        $task = $this->task->find($taskId);
        $task->end = $input['end'];
        $task->save();
        $task = $this->task->find($taskId);
        return [ 'end' => $task->end ];
    }

    public function destroy($taskId)
    {
        $this->task->find($taskId)->delete();
        return;
    }
}
