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
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{--        @fluxAppearance--}}

</head>
<body class="min-h-screen bg-white dark:bg-zinc-800 text-zinc-800 dark:text-zinc-100">
<flux:header container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 h-17 ">


    <a href="{{ route('home') }}" class="ms-2 me-5 flex items-center space-x-2 rtl:space-x-reverse lg:ms-0" wire:navigate>
        <x-app-logo  />
    </a>
    <flux:spacer />
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="right" />
    <flux:spacer class="hidden lg:flex"/>
    <flux:navbar class="max-lg:hidden ">
        <flux:navbar.item  :href="route('home')" :current="request()->routeIs('home')" wire:navigate>
            {{ __('Home') }}
        </flux:navbar.item>
        <flux:navbar.item  href="/test" :current="request()->routeIs('test')" wire:navigate>
            {{ __('Home') }}
        </flux:navbar.item>
    </flux:navbar>

    <div class="w-20 hidden lg:block" ></div>

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

<flux:main>
    {{ $slot }}
</flux:main>
<footer class="footer pt-5 mt-5 " style="background-color:#5a666c; color: white;">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4 pb-4 pd-md-0  text-center">
                <div class="row">
                    <div class="col-12 text-center">
                        <img src="{{ asset('images/logo-white.png')}}" alt="icon" class="img-fluid" width="150px" />
                    </div>

                </div>
            </div>
            <div class="col-6 col-md-4 footerLink text-center">
                <h6 class="text-uppercase">{{ __('Contact Us') }}</h6>
                <p> 2300 Yonge Street, Suite 2002 <br>
                    Toronto, Ontario<br>M4P 1E4<br>
                    <a href=" tel:+14163600310">(416) 360-0310</a><br>
                    <a href="mailto:info@ehpfunds.com">info@ehpfunds.com</a>
                </p>
            </div>
            <div class="col-6 col-md-4 footerLink text-center">
                <h6 class="text-uppercase">{{ __('Legal') }}</h6>
                <ul class="list-unstyled">
                    <li> <a href="{{ route('terms') }}">{{ __('Legal and Terms of Use') }}</a> </li>
                    <li><a href="{{ route('privacy') }}">{{ __('Privacy policy') }}</a> </li>
                    <li><a href="{{ route('legal') }}">{{ __('Proxy Voting') }}</a> </li>
                </ul>
                <div class="col-12 text-center">&copy; EHP Funds Inc. 2019</div>
            </div>



        </div>
        <div class="row ">
            <div class="col-12 text-center footerLink d-flex justify-content-center">
                <ol class="breadcrumb text-uppercase mx-auto">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('about')}}">{{ __('About') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('funds')}}">{{ __('Funds') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('advisors')}}">{{ __('Advisors') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('invest')}}">{{ __('Invest') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('news')}}">{{ __('News') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('contact')}}">{{ __('Contact') }}</a></li>
                </ol>
            </div>

        </div>
    </div>
    <!-- end container -->
</footer>
@livewireScriptConfig
@fluxScripts
</body>
</html>
