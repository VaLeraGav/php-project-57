@extends('layouts.app')

@section('content')
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 ">
        <div class="grid col-span-full">
            <h1 class="mb-5">{{  __('tasks.Tasks') }}</h1>

            <div class="w-full flex items-center">
                <div>
                    {{-- {{Form::open(['route' => 'tasks.index', 'method' => 'GET'])}} --}}
                    <form method="GET" action="{{ route('tasks.index') }}" accept-charset="UTF-8"
                          class="">
                        <div class="flex">
                            <div>

{{--                                <select name="filter[status_id]" class="form-select ml-2 rounded border-gray-300">--}}
{{--                                    @if(empty($taskStatuses))--}}
{{--                                        <option selected="selected">--}}
{{--                                            {{  __('tasks.Status') }}--}}
{{--                                        </option>--}}
{{--                                    @else--}}
{{--                                        @foreach ($taskStatuses as $key => $var)--}}
{{--                                            @if($key === 2)--}}
{{--                                                <option selected="selected">--}}
{{--                                                    {{  __('tasks.Status') }}--}}
{{--                                                </option>--}}
{{--                                            @endif--}}
{{--                                            <option value="{{ $key }}" @selected(old('version') == $var)>--}}
{{--                                                {{ Str::limit($var, 15) }}--}}
{{--                                            </option>--}}
{{--                                        @endforeach--}}
{{--                                    @endif--}}
{{--                                </select>--}}

                                 {{Form::select('filter[status_id]', $taskStatuses, $filter['status_id'] ?? null, ['placeholder' => 'Статус', 'class' => 'form-select ml-2 rounded border-gray-300'])}}
                            </div>
                            <div>
{{--                                <select name="filter[created_by_id]" class="ml-2 rounded border-gray-300">--}}
{{--                                    @if(empty($users))--}}
{{--                                        <option selected="selected">--}}
{{--                                            {{  __('tasks.Authors') }}--}}
{{--                                        </option>--}}
{{--                                    @else--}}
{{--                                        @foreach ($users as $key => $var)--}}
{{--                                            @if($key === 2)--}}
{{--                                                <option selected="selected">--}}
{{--                                                    {{  __('tasks.Authors') }}--}}
{{--                                                </option>--}}
{{--                                            @endif--}}
{{--                                            <option value="{{ $key }}" @selected(old('version') == $var)>--}}
{{--                                                {{ Str::limit($var, 30) }}--}}
{{--                                            </option>--}}
{{--                                        @endforeach--}}
{{--                                    @endif--}}
{{--                                </select>--}}
                                 {{Form::select('filter[created_by_id]', $users, $filter['created_by_id'] ?? null, ['placeholder' => 'Авторы', 'class' => 'ml-2 rounded border-gray-300'])}}
                            </div>
                            <div>
{{--                                <select name="filter[assigned_to_id]" class="ml-2 rounded border-gray-300">--}}
{{--                                    @if(empty($users))--}}
{{--                                        <option selected="selected">--}}
{{--                                            {{  __('tasks.Performer') }}--}}
{{--                                        </option>--}}
{{--                                    @else--}}
{{--                                        @foreach ($users as $key => $var)--}}
{{--                                            @if($key === 2)--}}
{{--                                                <option selected="selected">--}}
{{--                                                    {{  __('tasks.Performer') }}--}}
{{--                                                </option>--}}
{{--                                            @endif--}}
{{--                                            <option value="{{ $key }}" @selected(old('version') == $var)>--}}
{{--                                                {{ Str::limit($var, 30) }}--}}
{{--                                            </option>--}}
{{--                                        @endforeach--}}
{{--                                    @endif--}}
{{--                                </select>--}}
                                 {{Form::select('filter[assigned_to_id]', $users, $filter['assigned_to_id'] ?? null, ['placeholder' => 'Исполнитель', 'class' => 'ml-2 rounded border-gray-300'])}}
                            </div>
                            <div>
                                <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2"
                                       type="submit" value="{{  __('tasks.Apply') }}">
                            </div>

                        </div>
                    </form>
                </div>

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
                                    @if(Auth::id() === $task->created_by_id)
                                        {{ print_r($task->created_by_id) }}
                                        <form action="{{ route('tasks.destroy', $task)}}"
                                              method="post" class=" float-left">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-danger btn-sm text-red-600 hover:text-red-900"
                                                    onclick="return confirm({{ __('tasks.Confirm deletion') }})">
                                                {{  __('tasks.Delete') }}
                                            </button>
                                        </form>
                                    @endif
                                    <a class="text-blue-600 hover:text-blue-900"
                                       href="{{ route("tasks.edit", $task) }}">{{  __('tasks.Edit') }}</a>
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
