@extends('common.user')
@section('content')

<h1 class="page-title">日報新規作成</h1>
<div class="contents-wrapper">
  <form class="clearfix" action="{{ route('report.store') }}" method="POST">
    @csrf
    <p class="label">日付</p>
    <input class="form-content" name="report_time" type="date">
    <p class="label">タイトル</p>
    <input class="form-content text-form title-form" name="title" type="text" placeholder="日報のタイトルを入力">
    <p class="label">詳細</p>
    <textarea class="form-content text-form detail-form" name="content" cols="50" rows="10" placeholder="日報の詳細を入力"></textarea>
    <button class="btn btn-create" type="submit">作成</button>
  </form>
</div>

@endsection