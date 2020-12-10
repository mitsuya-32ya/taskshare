@component('layouts.app')
@slot('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
  ユーザー一覧
</h2>
@endslot
<div class="container">
  @foreach($all_users as $user)
  <div class="bg-white border rounded-sm border-gray-300 my-3 mx-3 p-3">
    <a class="hover:bg-gray-300" href="{{ url('users/' .$user->id) }}">{{ $user->name }}</a>
  </div>
  @endforeach
</div>
<div class="">
  {{ $all_users->links() }}
</div>
@endcomponent