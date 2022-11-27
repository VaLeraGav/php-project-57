@extends('layouts.app')

@section('content')
    <div class="grid col-span-full">
        <h1 class="mb-5">Создать задачу</h1>

        <form method="POST" action="/tasks" accept-charset="UTF-8" class="w-50">
            <input name="_token" type="hidden" value="O4lB6DghsKQkXUShttwb4AhqTY57stdUc6nxfkMF">
            <div class="flex flex-col">
                <div>
                    <label for="name">Имя</label>
                </div>
                <div class="mt-2">
                    <input class="rounded border-gray-300 w-1/3" name="name" type="text" id="name">
                </div>
                <div class="mt-2">
                    <label for="description">Описание</label>
                </div>
                <div>
                    <textarea class="rounded border-gray-300 w-1/3 h-32" cols="50" rows="10" name="description"
                              id="description"></textarea>
                </div>
                <div class="mt-2">
                    <label for="status_id">Статус</label>
                </div>
                <div>
                    <select class="rounded border-gray-300 w-1/3" id="status_id" name="status_id">
                        <option selected="selected" value="">----------</option>
                        <option value="1">новая</option>
                        <option value="2">завершена</option>
                    </select>
                </div>
                <div class="mt-2">
                    <label for="assigned_to_id">Исполнитель</label>
                </div>
                <div>
                    <select class="rounded border-gray-300 w-1/3" id="assigned_to_id" name="assigned_to_id">
                        <option selected="selected" value="">----------</option>
                        <option value="1">Белоусоваа Татьяна Романовна</option>
                        <option value="2">Василий Дмитриевич Михайлов</option>
                        <option value="3">Павел Андреевич Капустина</option>
                    </select>
                </div>
                <div class="mt-2">
                    <label for="labels">Исполнитель</label>
                </div>
                <div>
                    <select multiple="multiple" name="labels[]" class="rounded border-gray-300 w-1/3 h-32" id="labels">
                        <option selected="selected" value=""></option>
                        <option value="1">ошибка</option>
                        <option value="2">документация</option>
                    </select>
                </div>
                <div class="mt-2">
                    <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit"
                           value="Создать">
                </div>
            </div>
        </form>
    </div>
@endsection
