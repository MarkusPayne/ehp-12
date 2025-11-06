@props([
    'mode' => 'single',
    'editable' => false,
    'time' => false,
    'month' => false
])
<div>

    <input x-data="date('{{ $mode }}','{{ $time }}','{{$month}}')" x-ref="picker" type="text" x-modelable="currentDate"
           autocomplete="off" name="{{ $attributes->wire('model')->value() }}"

        {{ $attributes->merge([
            'class' => 'flex-1 border-gray-300 block w-full transition duration-150 ease-in-out ',
        ]) }}>

</div>
@script
<script>

    Alpine.data('date', (mode = 'single', enableTime = false, monthOnly = false) => ({
        picker: null,
        currentDate: '',
        mode: mode,
        enableTime: enableTime,
        monthOnly: monthOnly,
        dateFormat: 'Y-m-d',
        init() {
            if (this.enableTime) {
                this.dateFormat = 'Y-m-d H:i:S';
            }
            if (this.monthOnly) {
                this.dateFormat = 'F d';
            }

            this.picker = flatpickr(this.$refs.picker, {
                dateFormat: this.dateFormat,
                disableMobile: 'true',
                mode: this.mode,
                currentDate: '',
                enableTime: this.enableTime,
                onChange: (date, dateString) => {
                    this.currentDate = dateString;
                    // return;
                    // if (this.mode === "single") {
                    //     this.value = dateString;
                    //     //   return;
                    // } else {
                    //     this.value = dateString.split(" to ");
                    // }
                },
            });
            this.$refs.picker.addEventListener('click', (e) => e.stopPropagation());
            this.$watch('currentDate', () => this.picker.setDate(this.currentDate));
        },
    }));
</script>

@endscript

