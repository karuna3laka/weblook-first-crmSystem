<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('invoice_id')->nullable()->constrained()->nullOnDelete();

            // Store Stripe identifiers
            $table->string('payment_id')->unique()->comment('Stripe PaymentIntent ID');
            $table->string('session_id')->nullable()->unique()->comment('Stripe Checkout Session ID');

            // Money + metadata
            $table->decimal('amount', 10, 2);
            $table->string('currency', 10)->default('usd');
            $table->string('status', 20)->default('pending'); // pending|paid|failed|refunded
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();

            $table->index(['customer_id', 'invoice_id']);
            $table->index(['status', 'paid_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
