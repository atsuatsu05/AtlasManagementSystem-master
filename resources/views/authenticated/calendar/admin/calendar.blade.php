@extends('layouts.sidebar')

@section('content')
<div class="border w-75 m-auto pt-5 pb-5 calendar_style">
<div class="w-75 m-auto ">
  <div class="w-100 m-auto">
    <p class="text-center">{{ $calendar->getTitle() }}</p>
    <p>{!! $calendar->render() !!}</p>
  </div>
</div>
</div>
@endsection
