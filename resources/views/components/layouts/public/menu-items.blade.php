<x-layouts.public.nav.item route="home">Home</x-layouts.public.nav.item>
<x-layouts.public.nav.dropdown route="about" menu-title="About" x-cloak>
    <x-layouts.public.nav.item route="about" section="about-firm" x-on:click="scrollToSection('about-firm')">Firm</x-layouts.public.nav.item>
    <x-layouts.public.nav.item route="about" section="about-process" x-on:click="scrollToSection('about-process')">Process</x-layouts.public.nav.item>
    <x-layouts.public.nav.item route="about" section="about-management-team" x-on:click="scrollToSection('about-management-team')">Management Team</x-layouts.public.nav.item>
    <x-layouts.public.nav.item route="about" section="about-careers" x-on:click="scrollToSection('about-careers')">Careers</x-layouts.public.nav.item>
</x-layouts.public.nav.dropdown>
<x-layouts.public.nav.item route="funds">Funds</x-layouts.public.nav.item>
<x-layouts.public.nav.item route="advisors">Advisors</x-layouts.public.nav.item>
<x-layouts.public.nav.item route="invest">Invest</x-layouts.public.nav.item>
<x-layouts.public.nav.item route="news">News</x-layouts.public.nav.item>
<x-layouts.public.nav.item route="contact">Contact</x-layouts.public.nav.item>
<x-layouts.public.nav.item route="set-locale" class="!text-xs" route-parameters="{{Str::take(Str::lower(session('toggle_locale','French')),2)}}">
    {{ __(session('toggle_locale', 'French')) }}
</x-layouts.public.nav.item>
