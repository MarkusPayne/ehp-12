<div x-data="{
    openNewTab(documentUrl) {
        console.log('Opening new tab...' + documentUrl)
        window.open(documentUrl, '_blank')
    },
}">
    <x-data-table>
        <x-slot:extraHeading>
            <div class="grid w-full grid-cols-12 gap-4">
                <x-input.group for="search.funds.fund_type_id" size="4">
                    <x-input.select wire:model.live="search.funds.fund_type_id" placeholder="Fund Type">
                        @foreach (\App\Models\FundType::getOptions() as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </x-input.select>
                </x-input.group>
                <x-input.group for="search.fund_documents.fund_id" size="4">
                    <x-input.select wire:model.live="search.fund_documents.fund_id" placeholder="Fund Name">
                        @foreach (\App\Models\Fund::getOptions() as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </x-input.select>
                </x-input.group>
                <x-input.group for="search.fund_documents.document_type_id" size="4">
                    <x-input.select wire:model.live="search.fund_documents.document_type_id" placeholder="Document Type">
                        @foreach (\App\Models\DocumentType::getOptions(['sortBy' => 'document_type_name', 'value' => 'document_type_name']) as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </x-input.select>
                </x-input.group>
            </div>
        </x-slot>
        <x-data-table.header>
            <x-data-table.row class="bg-gray-300 hover:bg-gray-300">
                <x-data-table.th class="py-3" sort-field="fund_name">Fund Name</x-data-table.th>
                <x-data-table.th sort-field="document_name">Document</x-data-table.th>
                <x-data-table.th sort-field="document_type_name">Type</x-data-table.th>
            </x-data-table.row>
        </x-data-table.header>
        <x-data-table.body>
            @foreach ($this->rows as $document)
                <x-data-table.row wire:key="currency-{{$document->id}}" x-on:click="openNewTab('{{Storage::temporaryUrl($document->file_name, now()->addMinutes(30))}}')" class="cursor-pointer">
                    <x-data-table.td>{{ $document->fund->name }}</x-data-table.td>
                    <x-data-table.td>{{ $document->document_name }}</x-data-table.td>
                    <x-data-table.td>{{ $document->documentType->document_type_name }}</x-data-table.td>
                </x-data-table.row>
            @endforeach
        </x-data-table.body>
    </x-data-table>
</div>
