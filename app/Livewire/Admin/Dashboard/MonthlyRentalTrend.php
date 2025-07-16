<?php

namespace App\Livewire\Admin\Dashboard;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MonthlyRentalTrend extends Component
{
    public $chartData;
    public $monthLabels;
    public $rentalCounts;
    public $revenueTotals;

    public function mount()
    {
        $this->generateMonthLabels();
        $this->loadMonthlyData();
        $this->prepareChartData();
    }

    public function generateMonthLabels()
    {
        // Generate month labels for the last 6 months
        $this->monthLabels = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $this->monthLabels[] = $date->format('M Y'); // e.g., "Jan 2025"
        }
    }

    public function loadMonthlyData()
    {
        // Get data for the last 6 months
        $endDate = Carbon::now()->endOfMonth();
        $startDate = Carbon::now()->subMonths(5)->startOfMonth();

        // Query rental data grouped by month
        $rentalData = DB::table('rentals')
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as rental_count'),
                // DB::raw('COALESCE(SUM(total_amount), 0) as revenue_total')
            )
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->keyBy(function ($item) {
                return $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT);
            });

        // Initialize arrays for each of the last 6 months
        $this->rentalCounts = [];
        // $this->revenueTotals = [];

        // Generate data for each of the last 6 months
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthKey = $date->format('Y-m');

            if (isset($rentalData[$monthKey])) {
                $this->rentalCounts[] = $rentalData[$monthKey]->rental_count;
                // $this->revenueTotals[] = $rentalData[$monthKey]->revenue_total;
            } else {
                $this->rentalCounts[] = 0;
                // $this->revenueTotals[] = 0;
            }
        }
    }

    public function prepareChartData()
    {
        $this->chartData = [
            'labels' => $this->monthLabels,
            'datasets' => [
                [
                    'label' => 'Monthly Rentals',
                    'data' => $this->rentalCounts,
                    'borderColor' => '#4DA34B',
                    'backgroundColor' => '#4DA34B',
                    'borderWidth' => 3,
                    'fill' => false,
                    'tension' => 0.2,
                    'pointBackgroundColor' => '#4DA34B',
                    'pointBorderColor' => '#ffffff',
                    'pointBorderWidth' => 2,
                    'pointRadius' => 6,
                    'pointHoverRadius' => 8,
                    'yAxisID' => 'y'
                ],
            ]
        ];
    }


    public function render()
    {
        return view('livewire.admin.dashboard.monthly-rental-trend');
    }
}
