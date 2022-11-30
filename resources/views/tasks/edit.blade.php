@extends('layouts.app')

@section('content')
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 ">
        <div class="grid col-span-full">
            <h1 class="mb-5">{{ __('tasks.Create a task') }}</h1>

            {{ Form::open(['url' => route('tasks.update', ['task' => $task]), 'method' => 'PUT', 'class' => 'w-50']) }}
            <div class="flex flex-col">
                <div>
                    <label for="name">{{ __('tasks.Name') }}</label>
                </div>
                <div class="mt-2">
                    <input class="rounded border-gray-300 w-1/3" name="name" type="text" id="name"
                           value="{{ $task->name }}">
                </div>
                <div class="d-block text-sm text-red-600 space-y-1">
                    @foreach ($errors->get('status_id') as $error)
                        {{ $error }}
                    @endforeach
                </div>

                <div class="mt-2">
                    <label for="description">{{ __('tasks.Description') }}</label>
                </div>
                <div>
                    <textarea class="rounded border-gray-300 w-1/3 h-32" cols="50" rows="10" name="description"
                              id="description">{{ $task->description }}</textarea>
                </div>
                <div class="d-block text-sm text-red-600 space-y-1">
                    @foreach ($errors->get('description') as $error)
                        {{ $error }}
                    @endforeach
                </div>

                <div class="mt-2">
                    <label for="status_id">{{ __('tasks.Status') }}</label>
                </div>
                <div>
                    {{ Form::select('status_id', $taskStatus, $task->status_id, ['class' => 'form-control rounded border-gray-300 w-1/3', 'placeholder' => '----------']) }}
                </div>
                <div class="d-block text-sm text-red-600 space-y-1">
                    @foreach ($errors->get('status_id') as $error)
                        {{ $error }}
                    @endforeach
                </div>

                <div class="mt-2">
                    <label for="assigned_to_id">{{ __('tasks.Performer') }}</label>
                </div>
                <div>
                    {{ Form::select('assigned_to_id', $users, $task->assigned_to_id, ['class' => 'form-control rounded border-gray-300 w-1/3', 'placeholder' => '----------']) }}
                </div>
                <div class="d-block text-sm text-red-600 space-y-1">
                    @foreach ($errors->get('assigned_to_id') as $error)
                        {{ $error }}
                    @endforeach
                </div>

                <div class="mt-2">
                    <label for="labels">{{ __('tasks.Performer') }}</label>
                </div>
                <div>
                    {{ Form::select('labels[]', $labels, $task->labels, ['class' => 'form-control rounded border-gray-300 w-1/3 h-32', 'multiple' => 'multiple']) }}
                </div>
                <div class="mt-2">
                    {{ Form::submit( __('tasks.Create'), ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
