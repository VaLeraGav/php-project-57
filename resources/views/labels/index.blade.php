@extends('layouts.app')

@section('content')
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 ">
        <div class="grid col-span-full">
            <h1 class="mb-5">{{ __('labels.Labels') }}</h1>

            @auth()
                <div>
                    <a href="{{ route('labels.create') }}"
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('labels.Create a label') }}</a>
                </div>
            @endauth

            <table class="mt-4">
                <thead class="border-b-2 border-solid border-black text-left">
                <tr>
                    <th>ID</th>
                    <th>{{ __('labels.Name') }}</th>
                    <th>{{ __('labels.Description') }}</th>
                    <th>{{ __('labels.Creation date') }}</th>
                    @auth
                        <th>{{ __('labels.Actions') }}</th>
                    @endauth
                </tr>
                </thead>
                @if (count($labels))
                    <tbody>
                    @foreach($labels as $label)
                        <tr class="border-b border-dashed text-left">
                            <td>{{ $label->id }}</td>
                            <td>{{ $label->name }}</td>
                            <td>{{ $label->description }}</td>
                            <td>{{ $label->created_at->format('d.m.Y') }}</td>
                            @auth()
                                <td>
                                    <a class="text-red-600 hover:text-red-900" rel="nofollow" data-method="delete"
                                       data-confirm="{{ __('labels.Confirm the deletion') }}"
                                       href="{{ route('labels.destroy', $label) }}">
                                        {{ __('labels.Delete') }}
                                    </a>

                                    <a class="text-blue-600 hover:text-blue-900"
                                       href="{{ route('labels.edit', $label->id) }}">{{ __('labels.Edit') }}
                                    </a>
                                </td>
                            @endauth
                        </tr>
                    @endforeach
                    </tbody>
                @endif
            </table>

            <div class="mt-4 grid col-span-full">{{ $labels->links() }}</div>

        </div>
    </div>
@endsection
