<div class="table-header-group" x-data="{ sortBy: false, sortDir:false, get isAsc() { return this.sortDir == 'ASC'} }">
    <div x-modelable="sortBy" wire:model.live="sortBy"></div>
    <div x-modelable="sortDir" wire:model.live="sortDir"></div>
    {{$slot}}
</div>
