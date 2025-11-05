<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>{{ $title ?? config('app.name') }}</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @livewireStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
{{--        @fluxAppearance--}}

    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:header container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 h-20 ">


            <a href="{{ route('home') }}" class="ms-2 me-5 flex items-center space-x-2 rtl:space-x-reverse lg:ms-0" wire:navigate>
                <x-app-logo  />
            </a>
            <flux:spacer />
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="right" />
            <flux:spacer class="hidden sm:flex"/>
            <flux:navbar class="max-lg:hidden ">
                <flux:navbar.item  :href="route('home')" :current="request()->routeIs('home')" wire:navigate>
                    {{ __('Home') }}
                </flux:navbar.item>
                <flux:navbar.item  href="/test" :current="request()->routeIs('test')" wire:navigate>
                    {{ __('Home') }}
                </flux:navbar.item>
            </flux:navbar>

            <div class="w-20 hidden sm:block" ></div>

            <flux:navbar class="me-1.5 space-x-0.5 rtl:space-x-reverse py-0! max-lg:hidden">
                <flux:dropdown>
                    <flux:navbar.item icon:trailing="chevron-down">Language</flux:navbar.item>
                    <flux:navmenu>
                        <flux:navmenu.item href="#">English</flux:navmenu.item>
                        <flux:navmenu.item href="#">French</flux:navmenu.item>

                    </flux:navmenu>
                </flux:dropdown>

            </flux:navbar>

            <!-- Desktop User Menu -->

        </flux:header>

        <!-- Mobile Menu -->
        <flux:sidebar stashable sticky class="lg:hidden border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <div class="flex items-center justify-between ">
                <a href="{{ route('home') }}" class="ms-1 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                    <x-app-logo class="!h-6"/>
                </a>
                <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />


            </div>


            <flux:navlist variant="outline">
                <flux:navlist.group>

                    <flux:navlist.item  :href="route('home')" :current="request()->routeIs('home')" wire:navigate>
                        {{ __('Home') }}
                    </flux:navlist.item>
                    <flux:navlist.item  href="/test" :current="request()->routeIs('test')" wire:navigate>
                        {{ __('Home 2') }}
                    </flux:navlist.item>



                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            <flux:navlist variant="outline">
                <flux:dropdown>
                    <flux:navbar.item icon:trailing="chevron-down">Language</flux:navbar.item>
                    <flux:navmenu>
                        <flux:navmenu.item href="#">English</flux:navmenu.item>
                        <flux:navmenu.item href="#">French</flux:navmenu.item>

                    </flux:navmenu>
                </flux:dropdown>

            </flux:navlist>
        </flux:sidebar>

        {{ $slot }}
        @livewireScriptConfig
        @fluxScripts
    </body>
</html>
