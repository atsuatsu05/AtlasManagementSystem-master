@extends('layouts.sidebar')
@section('content')
<div class="w-75 m-auto calendar_style d-flex" style="align-items:center; justify-content:center;">
  <div class="w-100   p-5">
    <p class="text-center">{{ $calendar->getTitle() }}</p>
    {!! $calendar->render() !!}
    <div class="adjust-table-btn  text-right">
      <input type="submit" class="btn btn-primary" value="登録" form="reserveSetting" onclick="return confirm('登録してよろしいですか？')">
    </div>
  </div>
</div>
@endsection
