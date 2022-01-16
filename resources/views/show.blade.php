@extends('common.user')
@section('content')

<h1 class="page-title">目標詳細</h1>
<div class="contents-wrapper">
  <div class="show-wrapper clearfix">
    <div class="target-show">
      <div class="target-title-box">
        <p class="target-title">{{ $target->title }}</p>
      </div>
      <div class="target-detail-box">
        <p class="target-detail">{!! nl2br($target->content) !!}</p>
      </div>
    </div>
    <p class="task-label-show">タスク</p>
    <table class="task-table task-show">
      <thead class="thead-index task-data-head">
        <tr class="table-head row-index tr-index">
          <th width="5%"><i class="fas fa-check-circle"></i></th>
          <th width="5%">順番</th>
          <th width="30%">タスク</th>
          <th width="20%">開始日</th>
          <th width="20%">終了予定日</th>
          <th width="20%">終了日</th>
        </tr>
      </thead>
      <tbody class="tasks">
        @foreach($tasks as $task)
        <tr class="row-index tr-index task-data" data-task-id={{ $task->id }}>
          <td class="col col1 check @if(!$task->end) no-checked @endif" width="5%" height="30px"><i class="fas fa-check-circle"></i></td>
          <td class="col col2" width="5%" height="30px">{{ $task->order }}</td>
          <td class="col col3" width="30%" height="30px">{{ $task->task }}</td>
          <td class="col col4" width="20%" height="30px">{{ $task->start }}</td>
          <td class="col col5" width="20%" height="30px">{{ $task->end_schedule }}</td>
          <td class="col col6 end" width="20%" height="30px">{{ $task->end }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <a href="{{ route('target.edit', $target->id) }}">
      <div class="btn btn-create btn-edit">編集</div>
    </a>
  </div>
</div>

<script src="{{ asset('js/show.js') }}"></script>

@endsection