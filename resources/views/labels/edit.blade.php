@extends('layouts.app')

@section('content')
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 ">
        <div class="grid col-span-full">
            <h1 class="mb-5">{{ __('labels.Change the label') }}</h1>

            <form method="POST" action="{{ route('labels.update',$label ) }}" accept-charset="UTF-8" class="w-50"><input
                    name="_method" type="hidden" value="PATCH">
                @csrf
                <div class="flex flex-col">
                    <div>
                        <label for="name">{{ __('labels.Name') }}</label>
                    </div>
                    <div class="mt-2">
                        <input class="rounded border-gray-300 w-1/3" name="name" type="text" value="{{ $label->name }}"
                               id="name">
                        @if ($errors->has('name'))
                            <div class="d-block text-sm text-red-600 space-y-1">
                                @foreach ($errors->get('name') as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="mt-2">
                        <label for="description">{{ __('labels.Description') }}</label>
                    </div>
                    <div class="mt-2">
                    <textarea class="rounded border-gray-300 w-1/3 h-32" name="description" cols="50" rows="10"
                              id="description">{{  $label->description }}</textarea>
                        @if ($errors->has('description'))
                            <div class="d-block text-sm text-red-600 space-y-1">
                                @foreach ($errors->get('description') as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="mt-2">
                        <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                               type="submit"
                               value={{ __('labels.Update') }}>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
