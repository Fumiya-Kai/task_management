@extends('common.user')
@section('content')

<h1 class="page-title">日報編集</h1>
<div class="contents-wrapper">
  <form class="clearfix" action="{{ route('report.update', $report->id) }}" method="POST">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <p class="label">日付</p>
    <input class="form-content" name="report_time" type="date" value="{{ $report->report_time->format('Y-m-d') }}">
    <p class="label">タイトル</p>
    <input class="form-content text-form title-form" name="title" type="text" value="{{ $report->title }}" placeholder="日報のタイトルを入力">
    <p class="label">詳細</p>
    <textarea class="form-content text-form detail-form" name="content" cols="50" rows="10" placeholder="日報の詳細を入力">{{ $report->content }}</textarea>
    <button class="btn btn-create" type="submit">変更</button>
  </form>
</div>

@endsection