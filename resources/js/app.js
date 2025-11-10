import { Alpine, Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm';
import { livewire_hot_reload } from 'virtual:livewire-hot-reload';
import Highcharts from 'highcharts';
import HighchartsAccessibility from 'highcharts/modules/accessibility';
import Glide from '@glidejs/glide';
import '@tailwindplus/elements';

window.Highcharts = Highcharts;
function initializeLibraries() {
    // Initialize Highcharts modules with the core instance
    try {
        if (typeof HighchartsAccessibility === 'function') HighchartsAccessibility(Highcharts);
    } catch (e) {
        console.error('[Highcharts] Module initialization failed:', e);
    }

    // Expose to window AFTER modules is initialized
    window.Highcharts = Highcharts;
    // const html = document.documentElement;
    // if (html.getAttribute('lang') === 'fr') {
    //     window.intl = 'fr-Latn-CA';
    // } else {
    //     window.intl = 'en-US';
    // }
}
initializeLibraries();

livewire_hot_reload();

function formatCurrency(val) {
    return new Intl.NumberFormat(window.appLocale, {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0,
        style: 'currency',
        currency: 'CAD',
    }).format(val);
}

function formatOrdinal(n) {
    const s = ['th', 'st', 'nd', 'rd'];
    const v = n % 100;
    return n + (s[(v - 20) % 10] || s[v] || s[0]);
}

function formatDateLabel(x) {
    const d = new Date(x);
    return `${d.toLocaleString(window.appLocale, { month: 'long' })} ${formatOrdinal(d.getDate())}, ${d.getFullYear()}`;
}
Alpine.data('lineChart', (seriesData) => ({
    init() {
        Highcharts.chart(this.$el, {
            title: {
                text: 'Growth of $100,000',
            },
            credits: false,

            subtitle: false,

            xAxis: {
                type: 'datetime',
            },
            tooltip: {
                formatter() {
                    return `${formatDateLabel(this.x)}: ${formatCurrency(this.y)}`;
                },
                useHTML: false,
            },
            yAxis: {
                labels: {
                    formatter: function () {
                        return formatCurrency(this.value);
                    },
                    style: { fontSize: '12px' },
                },
                title: {
                    text: undefined,
                },
            },
            plotOptions: {
                series: {
                    marker: {
                        enabled: false,
                    },
                    color: '#1a2857',
                },
            },

            series: [
                {
                    name: 'Investment',
                    showInLegend: false,
                    data: seriesData,
                },
            ],
            responsive: {
                rules: [
                    {
                        condition: {
                            maxWidth: 500,
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom',
                            },
                        },
                    },
                ],
            },
        });
    },
}));

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
        this.activeSection = sectionId;
        const element = document.getElementById(sectionId);
        if (element) {
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
