<ul role="list" {{ $attributes->class(['-mx-2 space-y-1']) }}>
    <x-nav.item icon="house" route="home">Dashboard</x-nav.item>

    <x-nav.item icon="chart-bar" route="lounge.results">Results</x-nav.item>

    <x-nav.item icon="calendar" route="lounge.combine-list">Combines</x-nav.item>

    <x-nav.item icon="star">Score</x-nav.item>

    <x-nav.item icon="dumbbell">Programs</x-nav.item>
    <x-nav.item icon="user" route="lounge.profile.show">Profile</x-nav.item>
    <x-nav.item icon="right-from-bracket" @click.prevent="$refs.logoutForm.submit();" x-data>
        <form method="POST" action="{{ route('logout') }}" x-ref="logoutForm">
            @csrf

            {{ __('Log Out') }}
        </form>
    </x-nav.item>
</ul>
