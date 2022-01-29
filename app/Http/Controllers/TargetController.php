<?php

namespace App\Http\Controllers;

use App\Models\Target;
use App\Models\Task;
use Illuminate\Http\Request;

class TargetController extends Controller
{
    private $target;
    private $task;

    public function __construct(Target $target, Task $task)
    {
        $this->target = $target;
        $this->task = $task;
    }

    public function index()
    {
        $targets = $this->target->getData();
        return view('index', compact('targets'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $this->target->createTarget($input);
        return redirect()->route('target.index');
    }

    public function show($targetId)
    {
        $target = $this->target->find($targetId);
        $tasks = $target->tasks->all();
        return view('show', compact('target', 'tasks'));
    }

    public function edit($targetId)
    {
        $target = $this->target->find($targetId);
        $tasks = $target->tasks->all();
        return view('edit', compact('target', 'tasks'));
    }

    public function update($targetId, Request $request)
    {
        $input = $request->all();
        $this->target->updateTarget($targetId, $input['targetData']);
        $this->task->updateTasks($targetId, $input['taskData']);
        return redirect()->route('target.show', $targetId);
    }
}
