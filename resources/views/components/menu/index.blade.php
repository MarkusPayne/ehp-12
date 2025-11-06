<div x-data="{ menuOpen: false }">
    <div x-menu x-model="menuOpen" class="relative flex flex-row-reverse items-center" {{ $attributes }} wire:ignore>
        {{ $slot }}
    </div>
</div>
