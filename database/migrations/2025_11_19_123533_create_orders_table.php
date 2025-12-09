<?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration {
//     public function up(): void
//     {
//         Schema::create('orders', function (Blueprint $table) {
//             $table->id();
//             $table->foreignId('user_id')->constrained()->onDelete('cascade');
//             $table->decimal('total_price', 10, 2);
//             $table->enum('status', ['pending', 'paid', 'shipped', 'completed', 'cancelled'])->default('pending');
//             $table->text('shipping_address')->nullable();
//             $table->string('payment_method')->nullable();
//             $table->timestamps();
//         });
//     }

//     public function down(): void
//     {
//         Schema::dropIfExists('orders');
//     }
// };

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // User who made the order
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Order Number (example: GRN-xxxx)
            $table->string('order_number')->unique();

            // Shipping Information
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('phone');
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('email');

            // Payment info
            $table->string('payment_method')->default('card');
            // $table->string('card_last4')->nullable();
            // $table->string('card_exp')->nullable();

            // Totals
            $table->decimal('subtotal', 10, 2);
            $table->decimal('shipping_fee', 10, 2)->default(15.00);
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('total', 10, 2);

            // Status tracking
            $table->enum('status', [
                'pending',
                'processing',
                'paid',
                'shipped',
                'delivered',
                'cancelled',
                'failed'
            ])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
