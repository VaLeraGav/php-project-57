@extends('layouts.app')

@section('content')
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 ">
        <div class="grid col-span-full">
            <h1 class="mb-5">Создать задачу</h1>

            {{ Form::open(['url' => route('tasks.store'), 'method' => 'POST', 'class' => 'w-50']) }}
            <div class="flex flex-col">
                <div>
                    {{ Form::label('name', 'Имя' ) }}
                </div>

                <div class="mt-2">
                    {{-- {{ Form::text('name', '', ['class' => 'form-control rounded border-gray-300 w-1/3']) }}--}}
                    <input class="rounded border-gray-300 w-1/3" name="name" type="text" id="name">
                </div>
                <div class="d-block text-sm text-red-600 space-y-1">
                    @foreach ($errors->get('name') as $error)
                        {{ $error }}
                    @endforeach
                </div>

                <div class="mt-2">
                    <label for="description">Описание</label>
                </div>
                <div>
                    <textarea class="rounded border-gray-300 w-1/3 h-32" cols="50" rows="10" name="description"
                              id="description"></textarea>
                </div>
                <div class="d-block text-sm text-red-600 space-y-1">
                    @foreach ($errors->get('description') as $error)
                        {{ $error }}
                    @endforeach
                </div>

                <div class="mt-2">
                    <label for="status_id">Статус</label>
                </div>
                <div>
                    {{ Form::select('status_id', $taskStatuses, null, ['class' => 'form-control rounded border-gray-300 w-1/3', 'placeholder' => '----------']) }}
                </div>
                <div class="d-block text-sm text-red-600 space-y-1">
                    @foreach ($errors->get('status_id') as $error)
                        {{ $error }}
                    @endforeach
                </div>

                <div class="mt-2">
                    <label for="assigned_to_id">Исполнитель</label>
                </div>
                <div>
                    {{ Form::select('assigned_to_id', $users, null, ['class' => 'form-control rounded border-gray-300 w-1/3', 'placeholder' => '----------']) }}
                </div>
                <div class="d-block text-sm text-red-600 space-y-1">
                    @foreach ($errors->get('assigned_to_id') as $error)
                        {{ $error }}
                    @endforeach
                </div>

                <div class="mt-2">
                    <label for="labels">Исполнитель</label>
                </div>
                <div>
                    {{ Form::select('labels[]', $labels, null, ['class' => 'form-control rounded border-gray-300 w-1/3 h-32', 'multiple' => 'multiple']) }}
                </div>
                <div class="mt-2">
                    {{ Form::submit('Create', ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
