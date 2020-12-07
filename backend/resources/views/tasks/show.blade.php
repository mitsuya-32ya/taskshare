@component('layouts.app')
@slot('header')
@endslot
<div class="container">
  <div class="bg-{{ $task->status_color }}-100 border rounded-sm border-{{ $task->status_color }}-300 my-5 mx-3">
    <div class="p-3 border-b border-{{ $task->status_color }}-300 flex justify-between">
      <div class="hover:text-{{ $task->status_color }}-700">
        <a href="{{ url('users/' . $task->user_id ) }}" class="">{{ $task->user->name }}</a>
      </div>
      <div class="flex">
        <div class="text-gray-400 mx-2">{{ $task->updated_at->format('Y-m-d H:i') }}</div>
      </div>
    </div>
    <div class="p-3 ">
      <p class="text-lg font-bold ">{{ $task->task_name }}</p>
      <div class="flex justify-between items-end">
        <div class="">
          <p>状態:{{ $task->status_name }}</p>
          <p>締切:{{ $task->due_date }}</p>
        </div>
        @if ($task->user->id === Auth::user()->id)
        <div class="flex">
        <p class="text-gray-400">[<a class="text-gray-500 hover:text-black" href="{{ url('tasks/' . $task->id . '/edit') }}">編集</a>]</p>
          <form method="POST" action="{{ url('tasks/' . $task->id) }}">
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
@endcomponent