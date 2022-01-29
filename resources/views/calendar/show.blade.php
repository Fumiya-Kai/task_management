@extends('common.user')
@section('content')

<h1 class="page-title">{{ $date }}のタスク</h1>
<div class="contents-wrapper">
  <div class="show-wrapper clearfix">
    <div class="task-all">
      <h2>全部のタスク</h2>
      <h3>開始するタスク</h3>
      @component('components.tasks_table', ['tasks' => $startTasks])
      @endcomponent
      <h3>進行中のタスク</h3>
      @component('components.tasks_table', ['tasks' => $inProgressTasks])
      @endcomponent
      <h3>終了予定のタスク</h3>
      @component('components.tasks_table', ['tasks' => $endTasks])
      @endcomponent
    </div>
  </div>
</div>

@endsection