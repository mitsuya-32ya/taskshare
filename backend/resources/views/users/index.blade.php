@component('layouts.app')
@slot('header')
@endslot
<div class="container">
  @foreach($all_users as $user)
  <div class="bg-white border rounded-sm border-gray-300 my-3 mx-3 p-3">
    <a class="hover:bg-gray-300" href="{{ url('users/' .$user->id) }}">{{ $user->name }}</p>
  </div>
  @endforeach
</div>
<div class="">
  {{ $all_users->links() }}
</div>
@endcomponent