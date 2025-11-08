import { Alpine, Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm';

import { livewire_hot_reload } from 'virtual:livewire-hot-reload';
import Glide from '@glidejs/glide';
import '@tailwindplus/elements';

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
        }).mount();
    },
}));

Alpine.data('navigation', () => ({
    open: false,
    activeSection: Alpine.$persist('careers').using(sessionStorage).as('activeSection'),
    init() {
        // this.testVar = this.$persist(0).using(sessionStorage);

        this.scrollToSection(this.activeSection);
        this.checkActiveSection();
        window.addEventListener('scroll', () => this.checkActiveSection());
    },

    scrollToSection(sectionId) {
        const element = document.getElementById(sectionId);
        if (element) {
            this.activeSection = sectionId;
            this.open = false;
            const offset = 80; // Adjust based on your header height
            const elementPosition = element.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - offset;

            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth',
            });
        }
    },

    checkActiveSection() {
        const sections = document.querySelectorAll('[data-section]');
        const scrollPosition = window.scrollY + 100; // Adjust offset as needed

        sections.forEach((section) => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            const sectionId = section.dataset.section;

            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                this.activeSection = sectionId;
            }
        });
    },
}));

Livewire.start();
