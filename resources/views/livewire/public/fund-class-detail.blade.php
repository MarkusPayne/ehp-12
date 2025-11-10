<div>
    <x-page-section>
        <x-page-section-content title="Detail">
            <div class="grid grid-cols-1 lg:grid-cols-7">
                <div class="p-2 lg:col-span-5">
                    {{-- <x-highcharts.line wire:ignore /> --}}
                    @if ($this->fundClass)
                        @dump($this->fundClass->returns)
                        @dump($this->fundClass->growth)
                        <div x-data="lineChart({{ json_encode($this->fundClass->growth) }})" class="highcharts-light min-h-90" wire:key="{{ rand() }}"></div>
                    @endif
                </div>
                <div class="p-2 lg:col-span-2">
                    <x-input.group for="fundClassId" size="4">
                        <x-input.select wire:model.live="fundClassId" placeholder="All">
                            @foreach ($this->fund->fundClasses as $class)
                                <option value="{{ $class->id }}">{{ $class->fund_class_name }}</option>
                            @endforeach
                        </x-input.select>
                    </x-input.group>
                    <x-dl class="border-b border-gray-100">
                        <x-dl.item label="Current Price">
                            {{ Number::currency($this->fundClass?->lastNav?->nav ?? 0, in: $this->fundClass?->currency, locale: app()->getLocale()) }}
                            <x-slot:note>
                                {{ __('As of') }}
                                @prettyDate($this->fundClass?->lastNav?->nav_date)
                            </x-slot>
                        </x-dl.item>
                        <x-dl.item label="Daily Change">{{ Number::currency($this->fundClass?->lastNav?->penny_change ?? 0) }} ({{ Number::percentage($this->fundClass?->lastNav?->percent_change, precision: 2) }})</x-dl.item>
                        <x-dl.item label="Latest Monthly Fund Profile">link</x-dl.item>
                    </x-dl>
                    <x-dl>
                        <x-dl.item label="{{ __('Portfolio') }}">{{ $this->fund->portfolio }}</x-dl.item>
                        <x-dl.item label="{{ __('Inception Date') }}">
                            @prettyDate($this->fundClass?->inception_date)
                        </x-dl.item>
                        <x-dl.item label="{{ __('Distributions') }}">{{ $this->fund->distributions }}</x-dl.item>
                        <x-dl.item label="{{ __('Registered Tax Plan Status') }}">{{ $this->fund->tax_plan_status }}</x-dl.item>
                        <x-dl.item label="{{ __('Management Fee') }}">{{ Number::percentage($this->fundClass?->management_fee, precision: 2) }}</x-dl.item>
                        <x-dl.item label="{{ __('Performance Fee') }}">{{ __($this->fund->performance_fee) }}</x-dl.item>
                        <x-dl.item label="{{ __('Minimum Initial Investment') }}">{{ Number::currency($this->fund->minimum_investment, precision: 0) }}</x-dl.item>
                        <x-dl.item label="{{ __('Minimum Subsequent Investment') }}">{{ Number::currency($this->fund->minimum_subsequent, precision: 0) }}</x-dl.item>
                        <x-dl.item label="{{ __('Liquidity') }}">{{ $this->fund->liquidity }}</x-dl.item>
                    </x-dl>
                </div>
            </div>
        </x-page-section-content>
    </x-page-section>

    <x-page-section>
        <x-page-section-content>
            @content('funds-disclaimer')
        </x-page-section-content>
    </x-page-section>
</div>
