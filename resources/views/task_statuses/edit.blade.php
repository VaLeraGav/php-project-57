@extends('layouts.app')

@section('content')
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 ">
        <div class="grid col-span-full">
            <h1 class="mb-5">Изменение статуса</h1>
            <form method="POST" action="{{ route('task_statuses.update', ['task_status' => $taskStatus]) }}"
                  accept-charset="UTF-8" class="w-50"><input name="_method" type="hidden" value="PATCH">
                @csrf
                <div class="flex flex-col">
                    <div>
                        <label for="name">Имя</label>
                    </div>
                    <div class="mt-2">
                        <input class="rounded border-gray-300 w-1/3" name="name" type="text"
                               value="{{ $taskStatus->name }}"
                               id="name">
                        @if ($errors->any())
                            <div class="d-block text-sm text-red-600 space-y-1">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="mt-2">
                        <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                               type="submit"
                               value="Обновить">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
