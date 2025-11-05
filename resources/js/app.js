import { Alpine, Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm';

import {livewire_hot_reload} from 'virtual:livewire-hot-reload'
// import Glide ,{ Autoplay,Controls } from '@glidejs/glide/dist/glide.modular.esm';
import Glide from '@glidejs/glide';
livewire_hot_reload();
Alpine.data('carousel', () => ({


    init() {
        //  console.log('init')
        new Glide(this.$refs.glide, {
            perView: 1,
            type: 'carousel',
            autoplay: 50000,
            startAt: 0,
            gap: 0,
            animationDuration: 500,
            animationTimingFunc: 'linear',
            focusAt: 'center',
            hoverpause: true,

        }).mount()
    },


}));

window.Glide = Glide;
Livewire.start();
