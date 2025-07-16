<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RentalPenaltyAndExtensionSeeder extends Seeder
{
    public function run(): void
    {
        // Penalties for overdue rentals
        $overdueRentals = Rental::where('status', 'overdue')->get();

        foreach ($overdueRentals as $rental) {
            $daysOverdue = abs(num: (int)Carbon::now()->diffInDays($rental->due_date));
            $penaltyAmount = $daysOverdue * 20;

            $paidAt = $rental->due_date->copy()->addDays(rand(1, 5));

            Payment::create([
                'user_id' => $rental->user_id,
                'rental_id' => $rental->id,
                'type' => 'penalty',
                'total_amount' => $penaltyAmount,
                'paid_amount' => $penaltyAmount,
                'paid_at' => $paidAt,
                'status' => 'paid',
                'payment_mode' => 'cash',
                'created_at' => $paidAt,
                'updated_at' => $paidAt,
            ]);
        }

        // Extensions for active rentals
        $rentedRentals = Rental::where('status', 'rented')->get();

        foreach ($rentedRentals as $rental) {
            $extensionWeeks = rand(1, 2);
            $extensionRate = rand(40, 80); // Rs. per week
            $extensionAmount = $extensionWeeks * $extensionRate;

            $paidAt = Carbon::now()->subDays(rand(0, 5));
            $newDueDate = $rental->due_date->copy()->addWeeks($extensionWeeks);

            // Update due date in rental
            $rental->due_date = $newDueDate;
            $rental->save();

            Payment::create([
                'user_id' => $rental->user_id,
                'rental_id' => $rental->id,
                'type' => 'extension',
                'total_amount' => $extensionAmount,
                'paid_amount' => $extensionAmount,
                'paid_at' => $paidAt,
                'status' => 'paid',
                'payment_mode' => 'cash',
                'created_at' => $paidAt,
                'updated_at' => $paidAt,
            ]);
        }
    }
}
