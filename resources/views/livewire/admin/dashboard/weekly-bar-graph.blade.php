<div class="rounded-lg border text-card-foreground bg-white shadow-sm">
    <div class="flex flex-col space-y-1.5 p-6">
        <h3 class="text-2xl font-semibold leading-none tracking-tight">Daily Rentals</h3>
        <p class="text-sm text-muted-foreground">Number of books rented this week</p>
    </div>
    <div class="p-6 pt-0">
        <div class="h-96" wire:ignore x-data="{
            chartData: @entangle('chartData'),
            rentalCounts: @entangle('rentalCounts'),
            chart: null,
            init() {
                this.initChart();

                // Listen for updated data
                $wire.on('refreshRentalsChart', () => {
                    $nextTick(() => {
                        console.log('Update Rentals Chart', this.rentalCounts);
                        if (this.chart) {
                            this.chart.data.datasets[0].data = this.rentalCounts;
                            this.chart.update('active');
                        }
                    });
                });
            },
            initChart() {
                const ctx = this.$refs.rentalsChart.getContext('2d');
                console.log(this.chartData);
                this.chart = new Chart(ctx, {
                    type: 'bar',
                    data: this.chartData,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: false,
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                titleColor: 'white',
                                bodyColor: 'white',
                                borderColor: 'rgba(255, 255, 255, 0.2)',
                                borderWidth: 1,
                                cornerRadius: 6,
                                displayColors: true,
                                callbacks: {
                                    label: function(context) {
                                        return context.dataset.label + ': ' + context.parsed.y + ' rentals';
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.1)',
                                    drawBorder: false,
                                },
                                ticks: {
                                    stepSize: 1,
                                    font: {
                                        size: 11
                                    },
                                    callback: function(value) {
                                        return value + ' rentals';
                                    }
                                },
                                title: {
                                    display: true,
                                    text: 'Number of Rentals',
                                    font: {
                                        size: 12,
                                        weight: 'bold'
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false,
                                },
                                ticks: {
                                    font: {
                                        size: 11
                                    }
                                },
                                title: {
                                    display: true,
                                    text: 'Day of Week',
                                    font: {
                                        size: 12,
                                        weight: 'bold'
                                    }
                                }
                            }
                        },
                        animation: {
                            duration: 1000,
                            easing: 'easeInOutQuart'
                        },
                        interaction: {
                            intersect: false,
                            mode: 'index'
                        }
                    }
                });
            }
        }">
            <canvas x-ref="rentalsChart" class="w-full"></canvas>
        </div>
    </div>
</div>
