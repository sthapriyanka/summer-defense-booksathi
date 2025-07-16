<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PaymentTypePieChart extends Component
{
    public $chartData = [];

    public function mount()
    {
        $types = DB::table('payments')
            ->select('type', DB::raw('SUM(paid_amount) as total'))
            ->where('status', 'paid')
            ->groupBy('type')
            ->pluck('total', 'type');

        $this->chartData = [
            'labels' => $types->keys(),
            'datasets' => [
                [
                    'data' => $types->values(),
                    'backgroundColor' => ['#3b82f6', '#f97316', '#ef4444', '#a855f7'],
                    'hoverOffset' => 6,
                ]
            ]
        ];
    }

    public function render()
    {
        return view('livewire.admin.payment-type-pie-chart');
    }
}
