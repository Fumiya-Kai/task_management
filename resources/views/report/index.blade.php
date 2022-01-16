@extends('common.user')
@section('content')

<h1 class="page-title">日報</h1>
<div class="contents-wrapper">
  <div class="btn"><a href="{{ route('report.create') }}" class="add-link">Add</a></div>
  <table class="targets-table">
    <thead class="thead-index">
      <tr class="row-index tr-index">
        <th class="col col1" width="30%">日付</th>
        <th class="col col2" width="70%">タイトル</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($reports as $report)
      <tr class="row-index tr-index target-data" data-report-id="{{ $report->id }}">
        <td class="col col1" width="30%">{{ $report->report_time->format('m/d(D)')}}</td>
        <td class="col col2" width="70%">{{ $report->title }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="paginater">
  </div>
</div>

@endsection