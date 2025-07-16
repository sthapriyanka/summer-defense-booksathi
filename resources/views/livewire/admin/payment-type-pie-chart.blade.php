<div class="rounded-lg border text-card-foreground bg-white shadow-sm">
    <div class="flex flex-col space-y-1.5 p-6">
        <h3 class="text-2xl font-semibold leading-none tracking-tight">Payment Type Distribution</h3>
        <p class="text-sm text-muted-foreground">Breakdown of payment types</p>
    </div>
    <div class="p-6 pt-0 flex justify-center">
        <div class="h-full" wire:ignore x-data="{
            chartData: @entangle('chartData'),
            chart: null,
            init() {
                this.initChart();
            },
            initChart() {
                const ctx = this.$refs.paymentTypePieChart.getContext('2d');
                console.log(this.chartData);
                this.chart = new Chart(ctx, {
                    type: 'pie',
                    data: this.chartData,

                });
            }
        }">
            <canvas x-ref="paymentTypePieChart" class="w-full"></canvas>
        </div>
    </div>
</div>
