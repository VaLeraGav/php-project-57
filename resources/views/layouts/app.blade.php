<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-token" content="_token">

    <title>{{ __('layout.title') }}</title>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body style="background: #cce2fd">
<div id="app">
    <header class="fixed w-full">
        <nav class="bg-white border-gray-200 py-2.5 dark:bg-gray-900 shadow-md">
            <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
                <a href="/" class="flex items-center">
                    <span
                        class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">{{ __('layout.title') }}</span>
                </a>
                @guest()

                    <div class="flex items-center lg:order-2">
                        <a href="{{ route("login") }}"
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('layout.login') }}</a>
                        <a href="{{ route("register") }}"
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">{{ __('layout.registration') }}</a>
                    </div>
                @endguest
                @auth()
                    <div class="flex items-center lg:order-2">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="{{ route("logout") }}"
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('layout.logout') }}
                        </a>
                    </div>
                @endauth

                <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1">
                    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                        <li>
                            <a href="{{ route('tasks.index') }}"
                               class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">{{ __('layout.tasks') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('task_statuses.index') }} "
                               class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">{{ __('layout.task_statuses') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('labels.index') }}"
                               class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">{{ __('layout.labels') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        {{--        @include('flash::message')  вывод с grid --}}
    </header>

    <section>
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
            @yield('content')
        </div>
        <hr style="
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: 0;
        border-top: 2px solid rgba(0, 0, 0, 0.1);
        ">
    </section>

</div>

</body>
</html>
