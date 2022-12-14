@extends('layouts.app')

@section('content')
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 ">
        <div class="grid col-span-full">
            <h1 class="mb-5">{{ __('tasks.Create a task') }}</h1>

            {{ Form::open(['url' => route('tasks.store'), 'method' => 'POST', 'class' => 'w-50']) }}
            <div class="flex flex-col">
                <div>
                    {{ Form::label('name', __('tasks.Name')) }}
                </div>

                <div class="mt-2">
                    {{ Form::text('name', '', ['class' => 'form-control rounded border-gray-300 w-1/3']) }}
                </div>
                <div class="d-block text-sm text-red-600 space-y-1">
                    @foreach ($errors->get('name') as $error)
                        {{ $error }}
                    @endforeach
                </div>

                <div class="mt-2">
                    {{ Form::label('description', __('tasks.Description')) }}
                </div>
                <div>
                    {{ Form::textarea('description', '', ['class' => 'rounded border-gray-300 w-1/3 h-32']) }}
                </div>
                <div class="d-block text-sm text-red-600 space-y-1">
                    @foreach ($errors->get('description') as $error)
                        {{ $error }}
                    @endforeach
                </div>

                <div class="mt-2">
                    {{ Form::label('status_id', __('tasks.Status')) }}
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
                    {{ Form::label('assigned_to_id', __('tasks.Performer')) }}
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
                    {{ Form::label('labels', __('tasks.Performer')) }}
                </div>
                <div>
                    {{ Form::select('labels[]', $labels, null, ['class' => 'form-control rounded border-gray-300 w-1/3 h-32', 'multiple' => 'multiple']) }}
                </div>
                <div class="mt-2">
                    {{ Form::submit( __('tasks.Create')), ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) }}
                </div>
            </div>
            {{ Form::close() }}

        </div>
    </div>
@endsection
