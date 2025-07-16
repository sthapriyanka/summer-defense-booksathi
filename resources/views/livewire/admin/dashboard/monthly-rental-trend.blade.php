<div class="rounded-lg border text-card-foreground bg-white shadow-sm">
    <div class="flex flex-col space-y-1.5 p-6">
        <h3 class="text-2xl font-semibold leading-none tracking-tight">Monthly Rental Trend</h3>
        <p class="text-sm text-muted-foreground">Rental trends over the past 6 months</p>
    </div>
    <div class="p-6 pt-0">
        <div class="h-96" wire:ignore x-data="{
            chartData: @entangle('chartData'),
            rentalCounts: @entangle('rentalCounts'),
            revenueTotals: @entangle('revenueTotals'),
            chart: null,
            init() {
                this.initChart();

                // Listen for updated data
                $wire.on('refreshMonthlyTrend', () => {
                    $nextTick(() => {
                        console.log('Update Monthly Trend', this.rentalCounts, this.revenueTotals);
                        if (this.chart) {
                            this.chart.data.datasets[0].data = this.rentalCounts;
                            this.chart.data.datasets[1].data = this.revenueTotals;
                            this.chart.update('active');
                        }
                    });
                });
            },
            initChart() {
                const ctx = this.$refs.monthlyTrendChart.getContext('2d');
                this.chart = new Chart(ctx, {
                    type: 'line',
                    data: this.chartData,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            mode: 'index',
                            intersect: false,
                        },
                        plugins: {
                            legend: {
                                display: false,
                                position: 'top',
                                labels: {
                                    padding: 20,
                                    usePointStyle: true,
                                    font: {
                                        size: 12
                                    }
                                }
                            },
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
                                        if (context.datasetIndex === 0) {
                                            return 'Rentals: ' + context.parsed.y;
                                        } else {
                                            return 'Revenue: $' + context.parsed.y.toLocaleString();
                                        }
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                display: true,
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
                                    text: 'Month',
                                    font: {
                                        size: 12,
                                        weight: 'bold'
                                    }
                                }
                            },
                            y: {
                                type: 'linear',
                                display: true,
                                position: 'left',
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(59, 130, 246, 0.1)',
                                },
                                ticks: {
                                    color: '#4DA34B',
                                    font: {
                                        size: 11
                                    }
                                },
                                title: {
                                    display: true,
                                    text: 'Number of Rentals',
                                    color: '#4DA34B',
                                    font: {
                                        size: 12,
                                        weight: 'bold'
                                    }
                                }
                            },
                            {{-- y1: {
                                type: 'linear',
                                display: true,
                                position: 'right',
                                beginAtZero: true,
                                grid: {
                                    drawOnChartArea: false,
                                },
                                ticks: {
                                    color: 'rgba(16, 185, 129, 0.8)',
                                    font: {
                                        size: 11
                                    },
                                    callback: function(value) {
                                        return '$' + value.toLocaleString();
                                    }
                                },
                                title: {
                                    display: true,
                                    text: 'Revenue ($)',
                                    color: 'rgba(16, 185, 129, 0.8)',
                                    font: {
                                        size: 12,
                                        weight: 'bold'
                                    }
                                }
                            } --}}
                        },
                        animation: {
                            duration: 1500,
                            easing: 'easeInOutQuart'
                        }
                    }
                });
            }
        }">
            <canvas x-ref="monthlyTrendChart" class="w-full"></canvas>
        </div>
    </div>
</div>
