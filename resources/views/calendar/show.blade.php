@extends('common.user')
@section('content')

<h1 class="page-title">{{ $date }}のタスク</h1>
<div class="contents-wrapper">
  <div class="show-wrapper clearfix">
    <div class="task-all">
      <h2 class="task-all task-category-1">全部のタスク</h2>
      <h3 class="task-category-2">開始するタスク</h3>
      @component('components.tasks_table', ['tasks' => $startTasks->all()])
      @endcomponent
      <h3 class="task-category-2">進行中のタスク</h3>
      @component('components.tasks_table', ['tasks' => $inProgressTasks->all()])
      @endcomponent
      <h3 class="task-category-2">終了予定のタスク</h3>
      @component('components.tasks_table', ['tasks' => $endTasks->all()])
      @endcomponent
    </div>
    @foreach($targetGroup as $target)
    <div class="each-target-task {{ 'target-'. $loop->iteration }}">
      @if($allTasks->filter(function($task, $key) use ($target){return $task->target_id === $target->target_id;})->first())
      <h2 class="task-category-1">
      {{ $allTasks->filter(function($task, $key) use ($target){return $task->target_id === $target->target_id;})
                  ->first()
                  ->target
                  ->title }}
      </h2>
      @else
      @continue
      @endif
      <h3 class="task-category-2">開始するタスク</h3>
      @component('components.tasks_table', ['tasks' => $startTasks->filter(function($task, $key) use ($target){return $task->target_id === $target->target_id;})->all()])
      @endcomponent
      <h3 class="task-category-2">進行中のタスク</h3>
      @component('components.tasks_table', ['tasks' => $inProgressTasks->filter(function($task, $key) use ($target){return $task->target_id === $target->target_id;})->all()])
      @endcomponent
      <h3 class="task-category-2">終了予定のタスク</h3>
      @component('components.tasks_table', ['tasks' => $endTasks->filter(function($task, $key) use ($target){return $task->target_id === $target->target_id;})->all()])
      @endcomponent
    </div>
    @endforeach
  </div>
</div>

@endsection