@props([

    'editable' => false,
])

<div x-data="{
    value: @entangle($attributes->wire('model')).live,
    init() {
        let picker = flatpickr(this.$refs.picker, {
            dateFormat: 'Y-m-d',
            onChange: (date, dateString) => {
                this.value = dateString.split(' to ')
            }
        })
        this.$watch('value', () => picker.setDate(this.value))
    },
}" class="mx-auto ">


    <input x-ref="picker" type="text"
        {{ $attributes->merge([
            'class' => 'flex-1 border-gray-300 block w-full transition duration-150 ease-in-out ',
        ]) }}>
</div>




