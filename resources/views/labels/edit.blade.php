@extends('layouts.app')

@section('content')
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 ">
        <div class="grid col-span-full">
            <h1 class="mb-5">{{ __('labels.Change the label') }}</h1>

            {{ Form::open(['url' => route('labels.update', $label), 'method' => 'PATCH', 'class' => 'w-50']) }}
            @csrf
            <div class="flex flex-col">
                <div>
                    {{ Form::label('name', __('labels.Name')) }}
                </div>
                <div class="mt-2">
                    {{ Form::text('name', $label->name, ['class' => 'form-control rounded border-gray-300 w-1/3']) }}
                    @if ($errors->has('name'))
                        <div class="d-block text-sm text-red-600 space-y-1">
                            @foreach ($errors->get('name') as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="mt-2">
                    {{ Form::label('name', __('labels.Description')) }}
                </div>
                <div class="mt-2">
                    {{ Form::textarea('description', $label->description, ['class' => 'form-control rounded border-gray-300 w-1/3 h-32', 'cols' => '50', 'rows' => '10']) }}
                    @if ($errors->has('description'))
                        <div class="d-block text-sm text-red-600 space-y-1">
                            @foreach ($errors->get('description') as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="mt-2">
                    {{ Form::submit(__('labels.Update'), ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) }}
                </div>

            </div>
            {{ Form::close() }}

        </div>
    </div>
@endsection
