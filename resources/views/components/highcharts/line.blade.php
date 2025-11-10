<div id="container" style="width: 100%; height: 400px" class="highcharts-light" {{ $attributes }}></div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chart = Highcharts.chart('container', {
            title: {
                text: 'Growth of $100,000',
            },
            credits: false,

            subtitle: false,

            yAxis: {
                labels: {
                    formatter: function () {
                        const formatted = new Intl.NumberFormat('en-US', {
                            minimumFractionDigits: 0,
                            maximumFractionDigits: 0,
                        }).format(this.value);
                        return `$${formatted}`;
                    },
                    style: { fontSize: '12px' },
                },
                // labels: {
                //     format: '${text}',
                // },
                // labels: {
                //     formatter: function () {
                //         let f = new Intl.NumberFormat(window.intl, {
                //             style: 'decimal',
                //             // /currency: 'USD',
                //             minimumFractionDigits: 0,
                //         });
                //         if (window.intl === 'fr-Latn-CA') {
                //             return f.format(this.value) + ' $';
                //         } else {
                //             return '$' + f.format(this.value);
                //         }
                //     },
                //     style: {
                //         fontSize: '12px',
                //     },
                // },
                title: {
                    text: undefined,
                },
            },

            xAxis: {
                type: 'datetime',
            },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
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
                    data: {{ json_encode($this->growth) }},
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
    });
</script>
