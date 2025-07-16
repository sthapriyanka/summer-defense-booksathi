<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItems;
use App\Models\Payment;
use App\Models\Rental;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RentalSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::inRandomOrder()->take(100)->get();//for data
        $books = Book::all();

        foreach ($users as $user) {
            $rentCount = rand(1, 3); // Each user rents 1–3 books
            $selectedBooks = collect();

            $retryLimit = 100;//here for unique book
            $retryCount = 1;
            // Select unique available books
            while ($retryCount <= $retryLimit && $selectedBooks->count() < $rentCount && $books->count() > 0) {
                $book = $books->random();

                if ($book->available_copies <= 0 || $selectedBooks->contains($book)) {
                    $retryCount++;
                    continue;
                }

                $selectedBooks->push($book);
                echo $retryCount . "\n";
            }

            if ($selectedBooks->isEmpty()) {
                continue;
            }

            $orderedAt = Carbon::now()->subDays(rand(10, 60));
            $orderTotal = 0;

            $order = Order::create([
                'order_number'  => strtoupper(Str::random(10)),
                'user_id'       => $user->id,
                'status'        => 'confirmed',
                'total_amount'  => 0, // will be updated later
                'payment_mode'  => 'cash',
                'ordered_at'    => $orderedAt,
                'created_at'    => $orderedAt,
                'updated_at'    => $orderedAt,
            ]);

            foreach ($selectedBooks as $book) {
                $rentalWeeks = rand(1, 4);
                $pricePerWeek = $book->rental_price_per_week;
                $totalPrice = $rentalWeeks * $pricePerWeek;

                $orderItem = OrderItems::create([
                    'order_id'               => $order->id,
                    'book_id'                => $book->id,
                    'rental_duration_weeks'  => $rentalWeeks,
                    'total_price'            => $totalPrice,
                    'created_at'             => $orderedAt,
                    'updated_at'             => $orderedAt,
                ]);

                $orderTotal += $totalPrice;

                $rentedAt = $orderedAt->copy()->addDays(rand(0, 2));
                $dueDate = $rentedAt->copy()->addWeeks($rentalWeeks);

                $isReturned = rand(0, 1) === 1;
                $returnedAt = $isReturned
                    ? $rentedAt->copy()->addDays(rand(5, $rentalWeeks * 7))
                    : null;

                $status = $returnedAt ? 'returned' : ($dueDate->isPast() ? 'overdue' : 'rented');

                Rental::create([
                    'user_id'        => $user->id,
                    'book_id'        => $book->id,
                    'order_item_id'  => $orderItem->id,
                    'rented_at'      => $rentedAt,
                    'due_date'       => $dueDate,
                    'returned_at'    => $returnedAt,
                    'status'         => $status,
                    'created_at'     => $rentedAt,
                    'updated_at'     => $rentedAt,
                ]);

                // Decrease available copies
                $book->available_copies -= 1;
                $book->save();
            }

            // Update total amount
            $order->update(['total_amount' => $orderTotal]);

            // Add payment
            $paidAt = $orderedAt->copy()->addDays(rand(0, 3));
            Payment::create([
                'user_id'      => $user->id,
                'order_id'     => $order->id,
                'type'         => 'order',
                'total_amount' => $orderTotal,
                'paid_amount'  => $orderTotal,
                'paid_at'      => $paidAt,
                'status'       => 'paid',
                'payment_mode' => 'cash',
                'created_at'   => $paidAt,
                'updated_at'   => $paidAt,
            ]);
        }
    }
}
