<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DailyIncomeGraph extends Component
{
    public $incomePerDay = [];
    public $chartData = [];
    public $weekDays = [];

    public function mount()
    {
        $this->generateWeekDays();
        $this->loadIncomeData();
        $this->prepareChartData();
    }

    public function generateWeekDays()
    {
        $this->weekDays = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $this->weekDays[] = $date->format('M d');
        }
    }

    public function loadIncomeData()
    {
        $startDate = Carbon::now()->subDays(6)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $data = DB::table('payments')
            ->select(DB::raw('DATE(paid_at) as date'), DB::raw('SUM(paid_amount) as total'))
            ->whereBetween('paid_at', [$startDate, $endDate])
            ->where('status', 'paid')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date');

        $this->incomePerDay = [];

        foreach ($this->weekDays as $day) {
            $date = Carbon::createFromFormat('M d', $day)->format('Y-m-d');
            $this->incomePerDay[] = $data[$date] ?? 0;
        }
    }

    public function prepareChartData()
    {
        $this->chartData = [
            'labels' => $this->weekDays,
            'datasets' => [
                [
                    'label' => 'Daily Income (Rs)',
                    'data' => $this->incomePerDay,
                    'backgroundColor' => '#38bdf8', // sky-400
                    'borderRadius' => 6,
                ]
            ]
        ];
    }

    public function render()
    {
        return view('livewire.admin.daily-income-graph');
    }
}
