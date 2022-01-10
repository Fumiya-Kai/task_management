<?php

namespace App\Http\Controllers;

use App\Models\Target;
use Illuminate\Http\Request;

class TargetController extends Controller
{
    private $target;

    public function __construct(Target $target)
    {
        $this->target = $target;
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
        $this->target->updateTarget($targetId, $input);
        return redirect()->route('target.show', $targetId);
    }
}
