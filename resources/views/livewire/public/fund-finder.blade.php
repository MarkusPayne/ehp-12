<div>
    <div class="grid w-full grid-cols-12 gap-4">
        <x-input.group for="fundTypeId" l size="4" label="Fund Type">
            <x-input.select wire:model.change="fundTypeId" placeholder="All">
                @foreach (\App\Models\FundType::getOptions() as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </x-input.select>
        </x-input.group>
        <x-input.group for="fundLocationId" size="4" label="Investment Universe">
            <x-input.select wire:model.change="fundLocationId" placeholder="All">
                @foreach (\App\Models\FundLocation::getOptions() as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </x-input.select>
        </x-input.group>
        <x-input.group for="riskLevelId" label="Risk Level" size="4">
            <x-input.select wire:model.change="riskLevelId" placeholder="All">
                @foreach (\App\Models\RiskLevel::getOptions() as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </x-input.select>
        </x-input.group>
    </div>
    <ul class="list-none space-y-5 !ps-0 pt-10">
        @foreach ($this->funds as $fund)
            <li class="cursor-pointer overflow-hidden bg-gray-100 px-4 py-4 hover:bg-blue-200/30" wire:key="{{ $fund->id }}" x-on:click="Livewire.navigate('{{ route('fund-detail', ['fund' => $fund->id]) }}')">
                {{-- <a href="{{ route('fund-detail', ['fund' => $fund->id]) }}"> --}}
                <div>
                    <h4 class="!font-medium text-primary">{{ __($fund->name) }}</h4>
                    <div class="hr-blue"></div>
                    <div>{!! __($fund->description) !!}</div>
                </div>
                {{-- </a> --}}
            </li>
        @endforeach
    </ul>
</div>
