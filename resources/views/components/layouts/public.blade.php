<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      class=" h-full bg-white antialiased"
>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="shortcut icon" href="{{ URL::asset('images/fav.svg') }}"/>
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Oswald:wght@200..700&family=Roboto+Slab:wght@100..900&display=swap"
        rel="stylesheet">
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>
<body class="h-full bg-white font-sans antialiased  min-vh-100">
<div class="h-full font-sans text-zinc-700 antialiased ">
    <div class=" min-h-screen  flex flex-col">
        <header class=" inset-x-0  z-50 " x-data="{ open: false }" x-cloak>
            <x-layouts.public.desktop-menu/>
            <x-layouts.public.mobile-menu/>
        </header>
        {{ app()->getLocale() }}
        <main class="grow text-zinc-700 dark:text-gray-200">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer aria-labelledby="footer-heading" class="relative py-10 mt-15 bg-gray-500 text-zinc-200 dark">
            <div class="mx-auto max-w-7xl px-6 pb-8 pt-4 lg:px-8 text-sm text-center">
                <div class="grid grid-cols-1 md:grid-cols-3 md:gap-8 gap-y-8">
                    <x-app-logo-light/>
                    <div>
                        <h6 class="">{{ __('Contact Us') }}</h6>
                        <address>
                            <div class="grid gap-y-1">
                                <div>2300 Yonge Street, Suite 2002</div>
                                <div>Toronto, Ontario</div>
                                <div>M4P 1E4</div>
                                <div><a href="tel:+14163600310">(416) 360-0310</a></div>
                                <div><a href="mailto:info@ehpfunds.com">info@ehpfunds.com</a></div>
                            </div>
                        </address>
                    </div>
                    <div class="">
                        <h6 class="">{{ __('Legal') }}</h6>
                        <div class="grid gap-y-1">
                            <div><a href="{{ route('terms') }}">{{ __('Legal and Terms of Use') }}</a></div>
                            <div><a href="{{ route('privacy') }}">{{ __('Privacy policy') }}</a></div>
                            <div><a href="{{ route('legal') }}">{{ __('Proxy Voting') }}</a></div>
                            <div class="text-center pt-5">&copy; EHP Funds Inc. 2019</div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@livewireScriptConfig
</body>
</html>
