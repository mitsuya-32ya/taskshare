@component('layouts.app')
@slot('header')


@endslot

@foreach ( $timelines as $timeline )
  <p>{{ $timeline->user->name }}</p>
  <p>{{ $timeline->task_name }}</p>
@endforeach

@endcomponent