<x-layouts.public>
    <x-page-header :image-url="asset('images/headers/header10.jpg')" title="Contact"/>



    <x-page-section>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <x-page-section-content title="Client Services">
                <p>2300 Yonge Street, Suite 2002 <br>
                    Toronto, Ontario<br> M4P 1E4</p>

                <p>{{ __('Phone') }}: <a href="tel:+14163600310">(416) 360-0310</a><br/>
                    {{ __('Toll Free') }}: <a href="tel:+18333603100">(833) 360-3100</a><br/>
                    {{ __('Fax') }}: <a href="tel:+14163600317">(416) 360-0317</a></p>

                <p>{{ __('Email') }}: <a href="mailto:info@ehpfunds.com"
                                         class="text-primary">info@ehpfunds.com</a>
                </p>
            </x-page-section-content>
            <x-advisor-list :$advisors location="Toronto" locationId="1"/>
            <x-advisor-list :$advisors location="Vancouver" locationId="2"/>
            <x-advisor-list :$advisors location="Montréal" locationId="3"/>
        </div>
    </x-page-section>
    <x-page-section>
        <div class=" ">
            <h4 class="uppercase">{{ __('Office') }}</h4>
            <div class="hr-blue"></div>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2885.842604577897!2d-79.39553858487332!3d43.67224315921782!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882b34ae7eaeb499%3A0xca434ec0e46dc5ed!2sehp+FUNDS!5e0!3m2!1sen!2sca!4v1551149595117"
                width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </x-page-section>
</x-layouts.public>
