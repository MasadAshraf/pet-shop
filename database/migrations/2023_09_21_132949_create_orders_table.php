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
            $table->uuid('user_id'); // Foreign key to user.id
            $table->uuid('order_status_id'); // Foreign key to order_statuses.id
            $table->uuid('payment_id'); // Foreign key to payments.id
            $table->uuid('uuid')->unique(); // UUID column
            $table->json('products'); // JSON column for products
            $table->json('address'); // JSON column for address
            $table->float('delivery_fee')->nullable(); // Nullable delivery fee
            $table->float('amount'); // Amount
            $table->timestamps();
            $table->timestamp('shipped_at')->nullable(); // Nullable shipped_at

        });

        // Add foreign key constraints
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('user_id')->references('uuid')->on('users');
            $table->foreign('order_status_id')->references('uuid')->on('order_statuses');
            $table->foreign('payment_id')->references('uuid')->on('payments');
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
