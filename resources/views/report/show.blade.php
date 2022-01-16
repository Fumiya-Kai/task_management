@extends('common.user')
@section('content')

<h1 class="page-title">{{ $report->report_time->format('Y/m/d(D)') }}の日報</h1>
<div class="contents-wrapper">
  <div class="show-wrapper clearfix">
    <div class="target-show">
      <div class="target-title-box">
        <p class="target-title">{{ $report->title }}</p>
      </div>
      <div class="target-detail-box">
        <p class="target-detail">{{ $report->content }}</p>
      </div>
    </div>
    <a href="{{ route('report.edit', $report->id) }}">
      <div class="btn btn-create btn-edit">編集</div>
    </a>
  </div>
</div>

@endsection