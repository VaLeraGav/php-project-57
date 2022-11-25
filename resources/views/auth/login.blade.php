@extends('layouts.guest')

@section('content')
    <h2 class="text-center"><a href="https://php-task-manager-ru.hexlet.app">Менеджер задач</a></h2>

    <!-- Validation Errors -->
    <div class='mb-4'>
        @if ($errors->any())
            <div class='font-medium text-red-600'>Упс! Что-то пошло не так:</div>
            <ul class='mt-3 list-disc list-inside text-sm text-red-600'>
                @foreach ($errors->all() as $error)
                    <li> {{ $error }} </li>

                @endforeach
            </ul>
        @endif
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Email Address -->
        <div>
            <label class="block font-medium text-sm text-gray-700" for="email">
                Email
            </label>

            <input
                class="rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring-blue-200 focus:ring-opacity-50 block mt-1 w-full"
                id="email" type="email" name="email" required="required" autofocus="autofocus">
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label class="block font-medium text-sm text-gray-700" for="password">
                Пароль
            </label>

            <input
                class="rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring-blue-200 focus:ring-opacity-50 block mt-1 w-full"
                id="password" type="password" name="password" required="required" autocomplete="current-password">
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring-blue-200 focus:ring-opacity-50"
                       name="remember">
                <span class="ml-2 text-sm text-gray-600">Запомнить меня</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">

            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    Забыли пароль?
                </a>
            @endif

            <button type="submit"
                    class="inline-flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-3">
                Войти
            </button>
        </div>
    </form>
@endsection
