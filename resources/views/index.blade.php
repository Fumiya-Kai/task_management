@extends('common.user')
@section('content')

<h1 class="page-title">目標</h1>
<div class="contents-wrapper">
  <div class="btn"><a href="{{ route('target.create') }}" class="add-link">Add</a></div>
  <table class="targets-table">
    <thead class="thead-index">
      <tr class="row-index tr-index">
        <th class="col col1"><i class="fas fa-check-circle"></i></th>
        <th class="col col2">id</th>
        <th class="col col3">目標</th>
        <th class="col col4">開始日</th>
        <th class="col col5">終了予定日</th>
        <th class="col col6">終了日</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($targets as $target)
      <tr class="row-index tr-index target-data" data-target-id="{{ $target->id }}">
        <td class="col col1" width="5%">@if ($target->end !== null)<i class="fas fa-check-circle"></i>@endif</td>
        <td class="col col2 target-id" width="5%">{{ $target->id }}</td>
        <td class="col col3" width="45%">{{ $target->title }}</td>
        <td class="col col4" width="15%">{{ $target->start }}</td>
        <td class="col col5" width="15%">{{ $target->end_schedule }}</td>
        <td class="col col6" width="15%">{{ $target->end }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="paginater">
    {{ $targets->links() }}
  </div>
</div>

<script src="{{ asset('js/index.js') }}"></script>

@endsection