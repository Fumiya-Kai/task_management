@extends('common.user')
@section('content')

<h1 class="page-title">目標新規作成</h1>
<div class="contents-wrapper">
  <form class="clearfix" action="{{ route('target.store') }}" method="POST">
    @csrf
    <p class="label">タイトル</p>
    <input class="form-content text-form title-form" name="targetData[title]" type="text" placeholder="目標のタイトルを入力">
    <p class="label">詳細</p>
    <textarea class="form-content text-form detail-form" name="targetData[content]" cols="50" rows="10" placeholder="目標の詳細を入力"></textarea>
    <p class="label">開始日</p>
    <input class="form-content" name="targetData[start]" type="date">
    <p class="label">終了予定日</p>
    <input class="form-content" name="targetData[end_schedule]" type="date">
    <p class="label">タスク</p>
    <table class="task-table" width="90%">
      <thead>
        <tr class="table-head">
          <th width="5%"></th>
          <th width="5%">順番</th>
          <th width="40%">タスク名</th>
          <th width="25%">開始日</th>
          <th width="25%">終了予定日</th>
        </tr>
      </thead>
      <tbody class="tasks">
        <tr class="task">
          <td width="5%" height="30px"><div class="minus-button"><i class="fas fa-minus"></i></div></td>
          <td width="5%" height="30px"><input class="form-content task-form order-form" name="taskData[0][order]" type="number" min="1"></td>
          <td width="40%" height="30px"><input class="form-content task-form text-form" name="taskData[0][task]" type="text"></td>
          <td width="25%" height="30px"><input class="form-content task-form" name="taskData[0][start]" type="date"></td>
          <td width="25%" height="30px"><input class="form-content task-form" name="taskData[0][end_schedule]" type="date"></td>
        </tr>
        <tr class="add-row">
          <td width="5%" height="30px"><div class="plus-button"><i class="fas fa-plus"></i></div></td>
          <td width="5%" height="30px"></td>
          <td width="40%" height="30px"></td>
          <td width="25%" height="30px"></td>
          <td width="25%" height="30px"></td>
        </tr>
      </tbody>
    </table>
    <button class="btn btn-create" type="submit">作成</button>
  </form>
</div>

<script src="{{ asset('js/create.js') }}"></script>

@endsection