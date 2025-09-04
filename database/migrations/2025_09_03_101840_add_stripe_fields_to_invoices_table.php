<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('invoices', function (Blueprint $table) {
        $table->string('stripe_session_id')->nullable()->unique()->after('invoice_number');
        $table->string('stripe_payment_intent_id')->nullable()->unique()->after('stripe_session_id');
    });
}

public function down(): void
{
    Schema::table('invoices', function (Blueprint $table) {
        $table->dropColumn(['stripe_session_id', 'stripe_payment_intent_id']);
    });
}

};
