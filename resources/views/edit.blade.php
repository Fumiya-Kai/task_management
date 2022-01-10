@extends('common.user')
@section('content')

<h1 class="page-title">目標編集</h1>
<div class="contents-wrapper">
  <form class="clearfix" action="{{ route('target.update', $target->id) }}" method="POST">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <p class="label">タイトル</p>
    <input class="form-content text-form title-form" name="targetData[title]" type="text" value="{{ $target->title }}" placeholder="目標のタイトルを入力">
    <p class="label">詳細</p>
    <textarea class="form-content text-form detail-form" name="targetData[content]" cols="50" rows="10" placeholder="目標の詳細を入力">{{ $target->content }}</textarea>
    <p class="label">開始日</p>
    <input class="form-content" name="targetData[start]" type="date" value="{{ $target->start }}">
    <p class="label">終了予定日</p>
    <input class="form-content" name="targetData[end_schedule]" type="date" value="{{ $target->end_schedule }}">
    <p class="label">終了日</p>
    <input class="form-content" name="targetData[end]" type="date" value="{{ $target->end }}">
    <p class="label">タスク</p>
    <table class="task-table" width="90%">
      <thead>
        <tr class="table-head">
          <th width="5%"></th>
          <th width="5%">順番</th>
          <th width="30%">タスク名</th>
          <th width="20%">開始日</th>
          <th width="20%">終了予定日</th>
          <th width="20%">終了日</th>
        </tr>
      </thead>
      <tbody class="tasks">
        @if(!$tasks)
        <tr class="task">
          <td width="5%" height="30px"><div class="minus-button"><i class="fas fa-minus"></i></div></td>
          <td width="5%" height="30px"><input class="form-content task-form order-form" name="taskData[0][order]" type="number" min="1"></td>
          <td width="30%" height="30px"><input class="form-content task-form text-form" name="taskData[0][task]" type="text"></td>
          <td width="20%" height="30px"><input class="form-content task-form" name="taskData[0][start]" type="date"></td>
          <td width="20%" height="30px"><input class="form-content task-form" name="taskData[0][end_schedule]" type="date"></td>
          <td width="20%" height="30px"><input class="form-content task-form" name="taskData[0][end]" type="date"></td>
        </tr>
        @else
        @foreach($tasks as $task)
        <tr class="task">
          <td width="5%" height="30px"><div class="minus-button"><i class="fas fa-minus"></i></div></td>
          <td width="5%" height="30px"><input class="form-content task-form order-form" name="taskData[{{ $loop->index }}][order]" type="number" min="1" value="{{ $task->order }}"></td>
          <td width="30%" height="30px"><input class="form-content task-form text-form" name="taskData[{{ $loop->index }}][task]" type="text" value="{{ $task->task }}"></td>
          <td width="20%" height="30px"><input class="form-content task-form" name="taskData[{{ $loop->index }}][start]" type="date" value="{{ $task->start }}"></td>
          <td width="20%" height="30px"><input class="form-content task-form" name="taskData[{{ $loop->index }}][end_schedule]" type="date" value="{{ $task->end_schedule }}"></td>
          <td width="20%" height="30px"><input class="form-content task-form" name="taskData[{{ $loop->index }}][end]" type="date" value="{{ $task->end ?: null }}"></td>
        </tr>
        <input class="task-id" type="hidden" name="taskData[{{ $loop->index }}][id]" value="{{ $task->id }}">
        @endforeach
        @endif
        <tr class="add-row">
          <td width="5%" height="30px"><div class="plus-button"><i class="fas fa-plus"></i></div></td>
          <td width="5%" height="30px"></td>
          <td width="30%" height="30px"></td>
          <td width="20%" height="30px"></td>
          <td width="20%" height="30px"></td>
          <td width="20%" height="30px"></td>
        </tr>
      </tbody>
    </table>
    <button class="btn btn-create" type="submit">変更</button>
  </form>
</div>

<script src="{{ asset('js/edit.js') }}"></script>

@endsection