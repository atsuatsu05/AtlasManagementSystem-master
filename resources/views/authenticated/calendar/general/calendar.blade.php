@extends('layouts.sidebar')

@section('content')
<div class=" pt-5" style="background:#ECF1F6;">
  <div class="border w-75 m-auto pt-5 pb-5 calendar_style" style="border-radius:5px; background:#FFF; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);">
    <div class="w-75 m-auto" style="border-radius:5px;">

      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="">
        {!! $calendar->render() !!}
      <div class="text-right ">
      <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
      </div>
      </div>

    </div>

  </div>
</div>
@endsection
