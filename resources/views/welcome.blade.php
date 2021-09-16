<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('judiciary-icon.png') }}" type="image/x-icon">

    <title>{{ config('app.name', 'Tool Procurement Centre | MoJ D&T') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="antialiased">
<div
    class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            <x-application-logo-software class="w-20 h-20 fill-current text-gray-500 mr-3"/>
            <h1 class="text-5xl pt-7 mb-4 text-grey-800">{{ config('app.name', 'Tooling Procurement Centre') }}</h1>
        </div>

        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="p-6">
                    <div class="flex items-center">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                             stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500">
                            <path
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <div class="ml-4 text-lg leading-7 font-semibold"><a
                                href="https://docs.google.com/document/d/1M0b2W5pSQ59OyXub0WsaT4Koshzg0l8yQxO8FRTBcYA"
                                class="underline text-gray-900 dark:text-white"
                                target="_blank">Assets Index</a></div>
                    </div>

                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                            Whilst the TPC is under development, documents related to the build can be found in the MoJ
                            Digital and Technology Google Drive account.
                        </div>
                    </div>
                </div>

                <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                    <div class="flex items-center">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                             stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500">
                            <path
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                        </svg>
                        <div class="ml-4 text-lg leading-7 font-semibold">
                            <a href="https://trello.com/b/gvZSw810/tooling-procurement-centre-tech-spike-task-tracker"
                               class="underline text-gray-900 dark:text-white"
                               target="_blank">
                                Tracking in Trello</a></div>
                    </div>

                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                            Keeping on top of tasks and requirements can be a disjointed task when engaging in
                            cross-department discussions. We use Trello to help us keep on top of things.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
            <div class="text-center text-sm text-gray-500 sm:text-left">
                &nbsp;
            </div>

            <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </div>
        </div>
    </div>
</div>
</body>
</html>
