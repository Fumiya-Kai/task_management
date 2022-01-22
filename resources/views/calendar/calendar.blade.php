@extends('common.user')
@section('content')

<h1 class="page-title">カレンダー</h1>
<div class="contents-wrapper">
  <div class="calendar {{ 'weeks-'. $calendarData->get('weeks') }}">
    <div class="calendar-cell day-header day-0">日</div>
    <div class="calendar-cell day-header day-1">月</div>
    <div class="calendar-cell day-header day-2">火</div>
    <div class="calendar-cell day-header day-3">水</div>
    <div class="calendar-cell day-header day-4">木</div>
    <div class="calendar-cell day-header day-5">金</div>
    <div class="calendar-cell day-header day-6">土</div>
    @foreach ($calendarData->get('data') as $date)
    <div class="calendar-cell {{ 'week-'. $date['week']. ' '. 'day-'. $date['day_of_week'] }}">
      <p>{{ $date['day'] }}</p>
    </div>
    @endforeach
  </div>
</div>

@endsection