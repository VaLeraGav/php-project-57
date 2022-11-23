
@extends('layouts.app')

@section('content')
    <div class="grid col-span-full">
        <h1 class="mb-5">Метки</h1>

        <div>
        </div>

        <table class="mt-4">
            <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Описание</th>
                <th>Дата создания</th>
            </tr>
            </thead>
            <tbody><tr class="border-b border-dashed text-left">
                <td>1</td>
                <td>ошибка</td>
                <td>Какая-то ошибка в коде или проблема с функциональностью</td>
                <td>23.11.2022</td>
                <td>
                </td>
            </tr>
            <tr class="border-b border-dashed text-left">
                <td>2</td>
                <td>документация</td>
                <td>Задача которая касается документации</td>
                <td>23.11.2022</td>
                <td>
                </td>
            </tr>
            </tbody></table>
    </div>
@endsection
