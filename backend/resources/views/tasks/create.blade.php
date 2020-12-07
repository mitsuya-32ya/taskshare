@component('layouts.app')
@slot('header')


@endslot
<div class="container">
  <div class="bg-white border rounded-sm border-gray-300 my-5 mx-3 p-3">
    <form method="POST" action="{{ route('tasks.store') }}">
      @csrf
      <div class="m-2">
        <label class="block">
          <span class="text-gray-700">課題名</span>
            @error('task_name')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
          <input class="form-input mt-1 block w-full" name="task_name" id="task_name" placeholder="書籍名など p○○~p○○">
        </label>
      </div>
      <div class="m-2">
        <label class="block">
          <span class="text-gray-700">期限</span>
          @error('due_date')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
          <input class="form-input mt-1 block w-full" name="due_date" id="due_date" placeholder="XXXX/YY/ZZ">
        </label>
      </div>
      <div class="m-2">
        <button class="py-1 px-2 border rounded border-transparent border-gray-300 text-gray-700 focus:outline-none focus:border-transparent bg-blue-200 hover:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50">
          作成
        </button>
      </div>

    </form>
  </div>
</div>

<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
<script>
  flatpickr(document.getElementById('due_date'), {
    locale: 'ja',
    dateFormat: "Y/m/d",
    minDate: new Date()
  });
</script>

@endcomponent