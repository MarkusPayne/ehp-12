<!-- Multi Select -->
<div x-data="choicesOptions" wire:ignore >
    <select x-ref="select" multiple >
        {{ $slot }}
    </select>
</div>
@push('scripts')
<script>
    //   document.addEventListener('alpine:init', () => {
    //       Alpine.data('autocomplete', () => ({

    function choicesOptions() {
        return {
            multiple: true,
            value: [1,2],
            options: [{
                    value: 1,
                    label: 'Caleb Porzio'
                },
                {
                    value: 2,
                    label: 'Jason Beggs'
                },
                {
                    value: 3,
                    label: 'Tweedle Dee'
                },
                {
                    value: 4,
                    label: 'Tweedle Dum'
                },
            ],
            init() {

                console.log(this.$refs.select.options)
                //this.options = this.$refs.select.options;
                this.options = Array.from(this.$refs.select.options)

                for (let i = 0; i <  this.options.length; i++) {
                    console.log(this.options[i].selected);
                    if(this.options[i].selected){
                        this.value.push(i);
                        console.log(i);
                    }
                }


                this.$nextTick(() => {
                    let choices = new Choices(this.$refs.select)

                    let refreshChoices = () => {
                        let selection = this.multiple ? this.value : [this.value]

                        choices.clearStore()
                        choices.setChoices(this.options.map(({
                            value,
                            label
                        }) => ({
                            value,
                            label,
                            selected: selection.includes(value),
                        })))
                    }

                    refreshChoices()

                    this.$refs.select.addEventListener('change', () => {
                        this.value = choices.getValue(true)
                    })

                    this.$watch('value', () => refreshChoices())
                    this.$watch('options', () => refreshChoices())
                })
            }
        }
    }
    //}))
    //})
</script>
@endpush
