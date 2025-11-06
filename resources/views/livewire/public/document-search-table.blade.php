<div x-data="{
        openNewTab(documentUrl){
            console.log('Opening new tab...'+documentUrl);
            window.open(documentUrl, '_blank');
        }
    }">
    <x-data-table>
        <x-slot:extraHeading>
            <x-input.text wire:model.debounce.500ms="searchTerm" placeholder="Search by fund name or document name"/>
        </x-slot:extraHeading>
        <x-data-table.header>
            <x-data-table.row>
                <x-data-table.th sort-field="fund_name">Fund Name</x-data-table.th>
                <x-data-table.th sort-field="document_name">Document</x-data-table.th>
                <x-data-table.th sort-field="document_type_name">Type</x-data-table.th>
            </x-data-table.row>
        </x-data-table.header>
        <x-data-table.body>
            @foreach ($this->rows as $document)
                <x-data-table.row
                    wire:key="currency-{{$document->id}}"
                    x-on:click="openNewTab('{{Storage::temporaryUrl($document->file_name, now()->addMinutes(30))}}')"
                    class="cursor-pointer"
                >
                    <x-data-table.td>{{ $document->fund->name }}</x-data-table.td>
                    <x-data-table.td>{{ $document->document_name }}</x-data-table.td>
                    <x-data-table.td>{{$document->documentType->document_type_name}}</x-data-table.td>
                </x-data-table.row>
            @endforeach
        </x-data-table.body>
    </x-data-table>
</div>
