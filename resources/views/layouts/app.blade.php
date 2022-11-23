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
<body>
<div id="app">
    <header class="fixed w-full">
        <nav class="bg-white border-gray-200 py-2.5 dark:bg-gray-900 shadow-md">
            <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
                <a href="/" class="flex items-center">
                    <span
                        class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">{{ __('layout.title') }}</span>
                </a>

                <div class="flex items-center lg:order-2">
                    <a href="/login"
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('layout.login') }}</a>
                    <a href="/register"
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">{{ __('layout.registration') }}</a>
                </div>

                <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1">
                    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                        <li>
                            <a href="/tasks"
                               class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">{{ __('layout.tasks') }}</a>
                        </li>
                        <li>
                            <a href="/task_statuses"
                               class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">{{ __('layout.task_statuses') }}</a>
                        </li>
                        <li>
                            <a href="/labels"
                               class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">{{ __('layout.labels') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section class="bg-white">
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
            @yield('content')
        </div>
    </section>
</div>


</body>
</html>
