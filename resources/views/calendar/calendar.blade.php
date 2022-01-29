@extends('common.user')
@section('content')

<h1 class="page-title">カレンダー</h1>
<div class="contents-wrapper">
  <div class="month-header">
    <a href="{{ route('calendar.index', 'day='. $calendarData->get('last')) }}"><div class="month-pager month-back"><</div></a>
    <div class="month">{{ $calendarData->get('year'). '年'. $calendarData->get('month'). '月' }}</div>
    <a href="{{ route('calendar.index', 'day='. $calendarData->get('next')) }}"><div class="month-pager month-next">></div></a>
  </div>
  <div class="calendar-wrapper">
    <div class="calendar-side">
      <form action="{{ route('calendar.index')}}" class="search-month-box">
        <input type="month" name="day" class="month-form">
        <button><i class="fa fa-search"></i></button>
      </form>
      <div class="legend start-legend">開始するタスク</div>
      <div class="legend in-progress-legend">進行中のタスク</div>
      <div class="legend completed-legend">終了するタスク</div>
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
      {{ 'week-'. $date['week']. ' '. 'day-'. $date['day_of_week'] }}" data-date="{{ $calendarData->get('year'). '-'. $calendarData->get('month'). '-'. $date['day'] }}">
        <p class="day">{{ $date['day'] }}</p>
        <div class="day-task">
          <div class="task-count start-tasks">{{ $date['start_tasks'] }}</div>
          <div class="task-count tasks-in-progress">{{ $date['tasks_in_progress'] }}</div>
          <div class="task-count completed-tasks">{{ $date['completed_tasks'] }}</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

@endsection