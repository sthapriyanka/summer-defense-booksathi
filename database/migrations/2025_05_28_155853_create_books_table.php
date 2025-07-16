<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author')->nullable();
            $table->string('isbn')->unique()->nullable();
            $table->text('description')->nullable();
            $table->date('publication_date')->nullable();
            $table->integer('pages')->nullable();
            $table->string('language')->default('English');
            $table->integer('rating')->default(0);
            $table->string('publisher')->nullable();
            $table->string('cover_image')->nullable();
            $table->decimal('rental_price_per_week', 8, 2);
            $table->integer('total_copies')->default(1);
            $table->integer('available_copies')->default(1);
            $table->boolean('is_featured')->default(false);
            $table->enum('status', ['active', 'inactive', 'rental'])->default('active');
            $table->timestamps();

            $table->index(['title', 'status']);
            $table->index(['is_featured', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
