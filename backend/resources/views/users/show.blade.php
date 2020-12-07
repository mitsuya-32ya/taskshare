@component('layouts.app')
@slot('header')
<div class="flex">
  @if($user->id === Auth::user()->id)
  <p class="mx-2 text-gray-700 font-bold">あなたの課題</p>
  @else
  <p class="mx-2 text-gray-700 font-bold">{{ $user->name }}さんの課題</p>
  @endif
  <p class="mx-2 text-gray-500">作業中の課題数:{{ $completed_task_count }}</p>
  <p class="mx-2 text-gray-500">完了した課題数:{{ $working_task_count }}</p>
</div>
@endslot

@foreach ( $timelines as $timeline )
<div class="container">
  <div class="bg-{{ $timeline->status_color }}-100 border rounded-sm border-{{ $timeline->status_color }}-300 my-5 mx-3">
    <div class="p-3 border-b border-{{ $timeline->status_color }}-300 flex justify-between">
      <div class="hover:text-{{ $timeline->status_color }}-700">
        <a href="{{ url('users/' .$user->id) }}" class="">{{ $timeline->user->name }}</a>
      </div>
      <div class="flex">
        <div class="text-gray-400 mx-2">{{ $timeline->updated_at->format('Y-m-d H:i') }}</div>
      </div>
    </div>
    <div class="p-3 ">
      <a href="{{ url('tasks/' . $timeline->id)}}" class="hover:text-{{ $timeline->status_color }}-700 text-lg font-bold ">{{ $timeline->task_name }}</a>
      <div class="flex justify-between items-end">
        <div class="">
          <p>状態:{{ $timeline->status_name }}</p>
          <p>締切:{{ $timeline->due_date }}</p>
        </div>
        @if ($timeline->user->id === Auth::user()->id)
        <div class="flex">
          <p class="text-gray-400">[<a class="text-gray-500 hover:text-black" href="{{ url('tasks/' . $timeline->id . '/edit') }}">編集</a>]</p>
          <form method="POST" action="{{ url('tasks/' .$timeline->id) }}">
            @csrf
            @method('DELETE')
            <p class="text-gray-400">[<button type="submit" class="text-red-400 hover:text-red-600">削除</button>]</p>
          </form>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>


@endforeach

@endcomponent