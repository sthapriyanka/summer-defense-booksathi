<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['confirmed', 'pending','cancelled'])->default('pending'); // pending, paid, cancelled etc
            $table->decimal('total_amount', 10, 2);
            $table->string('payment_mode')->nullable();
            $table->timestamp('ordered_at')->useCurrent();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });

    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
