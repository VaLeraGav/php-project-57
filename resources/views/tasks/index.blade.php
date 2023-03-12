@extends('layouts.app')

@section('content')
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 ">
        <div class="grid col-span-full">
            <h1 class="mb-5">{{  __('tasks.Tasks') }}</h1>

            <div class="w-full flex items-center">

                {{Form::open(['route' => 'tasks.index', 'method' => 'GET'])}}
                <div class="flex">
                    <div>
                        {{Form::select('filter[status_id]', $taskStatuses, $filter['status_id'] ?? null, ['placeholder' => 'Статус', 'class' => 'form-select ml-2 rounded border-gray-300'])}}
                    </div>
                    <div>
                        {{Form::select('filter[created_by_id]', $users, $filter['created_by_id'] ?? null, ['placeholder' => 'Авторы', 'class' => 'ml-2 rounded border-gray-300'])}}
                    </div>
                    <div>
                        {{Form::select('filter[assigned_to_id]', $users, $filter['assigned_to_id'] ?? null, ['placeholder' => 'Исполнитель', 'class' => 'ml-2 rounded border-gray-300'])}}
                    </div>
                    <div>
                        <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2"
                               type="submit" value="{{  __('tasks.Apply') }}">
                    </div>
                </div>
                {{Form::close()}}

                <div class="ml-auto">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        @auth()
                            @csrf
                            <a href="{{ route('tasks.create') }}"
                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{  __('tasks.Create a task') }}</a>
                        @endauth
                    </div>
                </div>
            </div>

            <table class="mt-4">
                <thead class="border-b-2 border-solid border-black text-left">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">{{ __('tasks.Status') }}</th>
                    <th scope="col">{{ __('tasks.Name') }}</th>
                    <th scope="col">{{ __('tasks.Author') }}</th>
                    <th scope="col">{{ __('tasks.Performer') }}</th>
                    <th scope="col">{{ __('tasks.Creation date') }}</th>
                    @auth
                        <th scope="col">{{ __('tasks.Edit') }}</th>
                    @endauth
                </tr>
                </thead>
                @if (count($tasks))
                    <tbody>
                    @foreach($tasks as $task)
                        <tr class="border-b border-dashed text-left">
                            <td>{{ $task->id }}</td>
                            <td>{{ $taskStatuses[$task->status_id] }}</td>
                            <td>
                                <a class="text-blue-600 hover:text-blue-900"
                                   href="{{ route('tasks.show', $task) }}">
                                    {{ $task->name }}
                                </a>
                            </td>
                            <td>{{ $users[$task->created_by_id] ?? null }}</td>
                            <td>{{ $users[$task->assigned_to_id] ?? null }}</td>
                            <td>{{ $task->created_at->format('d.m.Y') }}</td>
                            @auth
                                <td>
                                    @can('delete', $task)
                                          <a href="{{ route('tasks.destroy', $task->id) }}"
                                             data-confirm="{{ __('tasks.Confirm deletion') }}" data-method="delete"
                                             rel="nofollow"
                                             class="btn btn-danger btn-sm text-red-600 hover:text-red-900">
                                              {{ __('tasks.Delete') }}
                                          </a>
                                    @endcan
                                    @can('update', $task)
                                        <a href="{{ route('tasks.edit', $task->id) }}"
                                           class="text-blue-600 hover:text-blue-900">
                                            {{ __('tasks.Edit') }}
                                        </a>
                                    @endcan
                                </td>
                            @endauth
                        </tr>
                    @endforeach
                    </tbody>
                @endif
            </table>

            <div class="mt-4 col-span-full">{{ $tasks->links() }}</div>

        </div>
@endsection
