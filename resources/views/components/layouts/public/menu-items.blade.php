<x-layouts.public.nav.item route="home" {{ $attributes }}> {{__('Home') }}</x-layouts.public.nav.item>
<x-layouts.public.nav.item route="about"> {{__('About') }}</x-layouts.public.nav.item>
<x-layouts.public.nav.item route="funds"> {{__('Funds') }}</x-layouts.public.nav.item>
<x-layouts.public.nav.item route="advisors"> {{__('Advisors') }}</x-layouts.public.nav.item>
<x-layouts.public.nav.item route="invest"> {{__('Invest') }}</x-layouts.public.nav.item>
<x-layouts.public.nav.item route="news"> {{__('News') }}</x-layouts.public.nav.item>
<x-layouts.public.nav.item route="contact"> {{__('Contact') }}</x-layouts.public.nav.item>
<x-layouts.public.nav.item route="set-locale" class="!text-xs"
                           route-parameters="{{Str::take(Str::lower(session('toggle_locale','French')),2)}}"> {{__(session('toggle_locale','French')) }}</x-layouts.public.nav.item>
