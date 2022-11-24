@extends('layouts.guest')

@section('content')
    <h2 class="text-center"><a href="/">Менеджер задач</a></h2>

    <!-- Validation Errors -->
    @if ($errors->any())
        <ul class='text-sm text-red-600 space-y-1'>
            @foreach ($errors->all() as $error)
                <li> {{ $error }}
                <li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <!-- Name -->
        <div>
            <label class="block font-medium text-sm text-gray-700" for="name">
                Имя
            </label>

            <input
                class="rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring-blue-200 focus:ring-opacity-50 block mt-1 w-full"
                id="name" type="text" name="name" required="required" autofocus="autofocus">
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label class="block font-medium text-sm text-gray-700" for="email">
                Email
            </label>

            <input
                class="rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring-blue-200 focus:ring-opacity-50 block mt-1 w-full"
                id="email" type="email" name="email" required="required">
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label class="block font-medium text-sm text-gray-700" for="password">
                Пароль
            </label>

            <input
                class="rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring-blue-200 focus:ring-opacity-50 block mt-1 w-full"
                id="password" type="password" name="password" required="required"
                autocomplete="new-password">
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label class="block font-medium text-sm text-gray-700" for="password_confirmation">
                Подтверждение
            </label>

            <input
                class="rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring-blue-200 focus:ring-opacity-50 block mt-1 w-full"
                id="password_confirmation" type="password" name="password_confirmation" required="required">
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900"
               href="{{ route('login') }}">
                Уже зарегистрированы?
            </a>

            <button type="submit"
                    class="inline-flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-4">
                Зарегистрировать
            </button>
        </div>
    </form>
@endsection
