@component('layouts.app')
@slot('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
  みんなの課題
</h2>
@endslot


@foreach ( $timelines as $timeline )
<div class="container m-auto">
  <div class="bg-{{ $timeline->status_color }}-100 border rounded-sm border-{{ $timeline->status_color }}-300 m-5">
    <div class="p-3 border-b border-{{ $timeline->status_color }}-300 flex justify-between">
      <div class="hover:text-{{ $timeline->status_color }}-700">
        <a href="{{ url('users/' . $timeline->user_id ) }}" class="">{{ $timeline->user->name }}</a>
      </div>
      <div class="flex">
        <div class="text-gray-400 mx-2">{{ $timeline->updated_at->format('Y-m-d H:i') }}</div>
      </div>
    </div>
    <div class="p-3 ">
      <div class="flex justify-between">
        <div><a href="{{ url('tasks/' . $timeline->id)}}" class="text-lg font-bold hover:text-{{ $timeline->status_color }}-700">{{ $timeline->task_name }}</a></div>
        @if ($timeline->status === 1 && $timeline->user->id === Auth::user()->id)
        <div>
          <form method="POST" action="{{ url('tasks/' . $timeline->id) }}">
            @csrf
            @method('PUT')
            <input type="hidden" class="form-input mt-1 block w-full" name="task_name" id="task_name" value="{{ $timeline->task_name }}">
            <input type="hidden" name="status" id="status" value="2">
            <input type="hidden" name="due_date" id="due_date" value="{{ $timeline->due_date }}">
            <button class="px-2 border rounded border-transparent border-gray-300 text-gray-700 focus:outline-none focus:border-transparent bg-blue-300 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-green-200 focus:ring-opacity-50">
              状態を完了に変更!!
            </button>
          </form>
        </div>
        @endif
      </div>
      <div>
        <p>状態:{{ $timeline->status_name }}</p>
      </div>
      <div class="flex justify-between">
        <div>
          <p>締切:{{ $timeline->due_date }}</p>
        </div>

        <div class="flex">
          <div class="mr-3 text-lg text-gray-400"><i class="far fa-comment fa-fw"></i>{{ count($timeline->comments) }}</div>
          <div class="mr-2 text-lg flex">

            @if (!in_array(Auth::user()->id, array_column($timeline->favorites->toArray(), 'user_id'), TRUE))
            <div>
              <form method="POST" action="{{ url('favorites/') }}" class="mb-0">
                @csrf

                <input type="hidden" name="task_id" value="{{ $timeline->id }}">
                <button type="submit" class="text-gray-400"><i class="far fa-heart fa-fw"></i></button>
              </form>
            </div>
            <div class="text-gray-400">
              {{ count($timeline->favorites) }}
            </div>
            @else
            <div>
              <form method="POST" action="{{ url('favorites/' .array_column($timeline->favorites->toArray(), 'id', 'user_id')[Auth::user()->id]) }}" class="mb-0">
                @csrf
                @method('DELETE')

                <button type="submit" class="text-red-600"><i class="fas fa-heart fa-fw"></i></button>
              </form>
            </div>
            <div class="text-red-600">
              {{ count($timeline->favorites) }}
            </div>
            @endif
          </div>
          @if ($timeline->user->id === Auth::user()->id)
          <div class="relative group">
            <div class="text-lg text-gray-400 hover:text-gray-600">
              <i class="fas fa-ellipsis-v fa-fw"></i>
            </div>
            <div class="absolute w-15 px-2 py-1 border rounded border-gray-200 invisible group-hover:visible bg-white">
              <a class="text-lg text-gray-400 hover:text-gray-700" href="{{ url('tasks/' . $timeline->id . '/edit') }}">編集</a>
              <form method="POST" action="{{ url('tasks/' . $timeline->id) }}">
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
@endforeach

<div class="mx-10 my-2">{{ $timelines->links() }}</div>


@endcomponent