@extends('common.user')
@section('content')

<h1 class="page-title">カレンダー</h1>
<div class="contents-wrapper">
  <div class="month-header">
    <a href="{{ route('calendar.index', 'day='. $calendarData->get('last')) }}"><div class="month-pager month-back"><</div></a>
    <div class="month">{{ $calendarData->get('year'). '年'. $calendarData->get('month'). '月' }}</div>
    <a href="{{ route('calendar.index', 'day='. $calendarData->get('next')) }}"><div class="month-pager month-next">></div></a>
  </div>
  <div class="calendar {{ 'weeks-'. $calendarData->get('weeks') }}">
    <div class="calendar-cell day-header day-0">日</div>
    <div class="calendar-cell day-header day-1">月</div>
    <div class="calendar-cell day-header day-2">火</div>
    <div class="calendar-cell day-header day-3">水</div>
    <div class="calendar-cell day-header day-4">木</div>
    <div class="calendar-cell day-header day-5">金</div>
    <div class="calendar-cell day-header day-6 border_r">土</div>
    @foreach ($calendarData->get('data') as $date)
    <div class="calendar-cell
    @if ($date['day_of_week'] === 6) border_r @endif
    @if ($date['week'] === $calendarData->get('weeks')) border_b @endif
    {{ 'week-'. $date['week']. ' '. 'day-'. $date['day_of_week'] }}">
      <p>{{ $date['day'] }}</p>
      <p>{{ $date['start_tasks'] }}</p>
      <p>{{ $date['tasks_in_progress'] }}</p>
      <p>{{ $date['completed_tasks'] }}</p>
    </div>
    @endforeach
  </div>
</div>

@endsection