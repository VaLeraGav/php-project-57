@extends('layouts.app')

@section('content')
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 ">
        <div class="grid col-span-full">
            <h1 class="mb-5">Статусы</h1>

            @auth()
                <div>
                    <a href="{{ route('task_statuses.create') }}"
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Создать статус</a>
                </div>
            @endauth

            <table class="mt-4">
                <thead class="border-b-2 border-solid border-black text-left">
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Дата создания</th>
                    @auth()
                        <th>Действия</th>
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
                                    <form action="{{ route('task_statuses.destroy', ['task_status' => $status->id]) }}"
                                          method="post" class=" float-left">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class=" btn btn-danger btn-sm "
                                                onclick="return confirm('Подтвердите удаление')">
                                            Удалить
                                        </button>
                                    </form>
                                    <a href="{{ route('task_statuses.edit', $status->id) }}">Изменить</a>
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
