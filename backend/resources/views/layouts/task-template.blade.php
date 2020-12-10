@component('layouts.app')
@slot('header')
{{ $header }}
@endslot
@slot('slot')

{{ $top }}

<div class="container m-auto">
  <div class="bg-{{ $task->status_color }}-100 border rounded-sm border-{{ $task->status_color }}-300 m-5">
    <div class="p-3 border-b border-{{ $task->status_color }}-300 flex justify-between">
      <div class="hover:text-{{ $task->status_color }}-700">
        <a href="{{ url('users/' . $task->user_id ) }}" class="">{{ $task->user->name }}</a>
      </div>
      <div class="flex">
        <div class="text-gray-400 mx-2">{{ $task->updated_at->format('Y-m-d H:i') }}</div>
      </div>
    </div>
    <div class="p-3 ">
      <a href="{{ url('tasks/' . $task->id)}}" class="text-lg font-bold hover:text-{{ $task->status_color }}-700">{{ $task->task_name }}</a>

      <div class="">
        <p>状態:{{ $task->status_name }}</p>
      </div>
      <div class="flex justify-between">
        <div>
          <p>締切:{{ $task->due_date }}</p>
        </div>

        <div class="flex">
          <div class="mr-3 text-lg text-gray-400"><i class="far fa-comment fa-fw"></i>{{ count($task->comments) }}</div>
          <div class="mr-2 text-lg flex">

            @if (!in_array(Auth::user()->id, array_column($task->favorites->toArray(), 'user_id'), TRUE))
            <div>
              <form method="POST" action="{{ url('favorites/') }}" class="mb-0">
                @csrf

                <input type="hidden" name="task_id" value="{{ $task->id }}">
                <button type="submit" class="text-gray-400"><i class="far fa-heart fa-fw"></i></button>
              </form>
            </div>
            <div class="text-gray-400">
              {{ count($task->favorites) }}
            </div>
            @else
            <div>
              <form method="POST" action="{{ url('favorites/' .array_column($task->favorites->toArray(), 'id', 'user_id')[Auth::user()->id]) }}" class="mb-0">
                @csrf
                @method('DELETE')

                <button type="submit" class="text-red-600"><i class="fas fa-heart fa-fw"></i></button>
              </form>
            </div>
            <div class="text-red-600">
              {{ count($task->favorites) }}
            </div>
            @endif
          </div>
          @if ($task->user->id === Auth::user()->id)
          <div class="relative group">
            <div class="text-lg text-gray-400 hover:text-gray-600">
              <i class="fas fa-ellipsis-v fa-fw"></i>
            </div>
            <div class="absolute w-15 px-2 py-1 border rounded border-gray-200 invisible group-hover:visible bg-white">
              <a class="text-lg text-gray-400 hover:text-gray-700" href="{{ url('tasks/' . $task->id . '/edit') }}">編集</a>
              <form method="POST" action="{{ url('tasks/' . $task->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-lg text-red-400 hover:text-red-700">削除</button>
              </form>
            </div>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

{{ $bottom }}

@endslot
@endcomponent