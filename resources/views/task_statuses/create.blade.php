@extends('layouts.app')

@section('content')

    <div class="grid col-span-full">

        <h1 class="mb-5">Создать статус</h1>

        <form method="POST" action=" {{ route('task_statuses.index') }}" accept-charset="UTF-8" class="w-50">
            @csrf
            <div class="flex flex-col">
                <div>
                    <label for="name">Имя</label>
                </div>
                <div class="mt-2">
                    <input class="rounded border-gray-300 lg:w-1/3" name="name" type="text" id="name">
                    @if ($errors->any())
                        <div class="d-block text-sm text-red-600 space-y-1">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="mt-2">
                    <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit"
                           value="Создать">
                </div>

            </div>
        </form>
    </div>
@endsection
