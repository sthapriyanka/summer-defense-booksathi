<?php

namespace App\Livewire\Admin\Dashboard;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class WeeklyBarGraph extends Component
{
    public $rentalCounts, $chartData, $weekDays;

    public function mount()
    {
        $this->generateWeekDays();
        $this->loadRentalDataForDateRange();
        $this->prepareChartData();
    }

    public function generateWeekDays()
    {
        // Generate week days for the last 7 days (including today)
        $this->weekDays = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $this->weekDays[] = $date->format('M d') . ' (' . $date->format('D') . ')';
        }
    }

    public function prepareChartData()
    {
        $this->chartData = [
            'labels' => $this->weekDays,
            'datasets' => [
                [
                    'label' => 'Daily Rentals',
                    'data' => $this->rentalCounts,
                    'backgroundColor' => [
                        '#4DA34B',
                    ],
                    'borderWidth' => 0,
                    'borderRadius' => 4,
                    'borderSkipped' => false,
                ]
            ]
        ];
    }

    public function loadRentalDataForDateRange()
    {
        $endDate = now()->endOfDay();
        $startDate = now()->subDays(6)->startOfDay();
        // Alternative method to load data for specific date range
        $rentalData = DB::table('rentals')
            ->select(DB::raw('DAYOFWEEK(created_at) as day_of_week, COUNT(*) as rental_count'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('day_of_week')
            ->orderBy('day_of_week')
            ->get()
            ->keyBy('day_of_week');
        // dd($rentalData);

        $this->rentalCounts = array_fill(0, 7, 0);

        foreach ($rentalData as $dayOfWeek => $data) {
            $index = ($dayOfWeek == 1) ? 6 : $dayOfWeek - 2;
            $this->rentalCounts[$index] = $data->rental_count;
        }
    }

    public function render()
    {
        return view('livewire.admin.dashboard.weekly-bar-graph');
    }
}
