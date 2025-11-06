<span {{ $attributes->class(['hover:bg-4 flex h-4 w-4 cursor-pointer items-center justify-around']) }}>
    <x-dynamic-component
        :component="'icons.regular.'.$icon"
        :class="collect(explode(' ', $attributes->get('class', '')))->filter(fn($class) => str_starts_with($class, 'h-'))->implode(' ')"
    />
</span>
