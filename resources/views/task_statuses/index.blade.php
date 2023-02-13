@extends('layouts.app')

@section('content')
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 ">
        <div class="grid col-span-full">
            <h1 class="mb-5">{{ __('task_statuses.Statuses') }}</h1>

            @auth()
                <div>
                    <a href="{{ route('task_statuses.create') }}"
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('task_statuses.Create a status') }}</a>
                </div>
            @endauth

            <table class="mt-4">

                <thead class="border-b-2 border-solid border-black text-left">
                <tr>
                    <th>ID</th>
                    <th>{{ __('task_statuses.Name') }}</th>
                    <th>{{ __('task_statuses.Creation date') }}</th>
                    @auth()
                        <th>{{ __('task_statuses.Actions') }}</th>
                    @endauth
                </tr>
                </thead>
                @if (count($taskStatuses))
                    <tbody>
                    @foreach($taskStatuses as $status)
                        <tr class="border-b border-dashed text-left">
                            <td>{{ $status->id }}</td>
                            <td>{{ $status->name }}</td>
                            <td>{{ $status->created_at->format('d.m.Y') }}</td>
                            @auth()
                                <td>
                                    <a class="text-red-600 hover:text-red-900"
                                       rel="nofollow" data-method="delete"
                                       data-confirm="{{ __('task_statuses.Confirm the deletion') }}"
                                       href="{{ route('task_statuses.destroy', $status->id) }}">
                                        {{ __('task_statuses.Delete') }}
                                    </a>
                                    <a class="text-blue-600 hover:text-blue-900"
                                       href="{{ route("task_statuses.edit", $status->id) }}">
                                        {{ __('task_statuses.Edit') }}
                                    </a>

                                </td>
                            @endauth
                        </tr>
                    @endforeach
                    </tbody>
                @endif
            </table>

            <div class="mt-4 grid col-span-full">{{ $taskStatuses->links() }}</div>

        </div>
    </div>
@endsection
