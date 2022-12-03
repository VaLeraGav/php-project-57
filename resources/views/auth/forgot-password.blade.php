@extends('layouts.guest')

@section('content')
    <!-- Validation Errors -->
    <div class='mb-4'>
        @if ($errors->any())
            <div class='font-medium text-red-600'>{{ __('errors.message') }}:</div>
            <ul class='mt-3 list-disc list-inside text-sm text-red-600'>
                @foreach ($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </ul>
        @endif
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="font-medium text-sm text-green-600 mb-4">
            {{ __('passwords.sent') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
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

        <div class="flex items-center justify-end mt-4">
            <button type="submit"
                    class="inline-flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('auth.Reset Password') }}
            </button>
        </div>
    </form>
@endsection

