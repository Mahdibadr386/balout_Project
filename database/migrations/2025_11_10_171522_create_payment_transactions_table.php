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
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable()->constrained('orders')->nullOnDelete();
            $table->string('gateway')->index();
            $table->string('gateway_transaction_id')->nullable()->index();
            $table->unsignedBigInteger('amount');
            $table->enum('status', ['initiated', 'pending', 'success', 'failed', 'refunded'])->default('initiated');
            $table->string('currency', 10)->default('IRR');
            $table->json('request_payload')->nullable();
            $table->json('response_payload')->nullable();
            $table->string('idempotency_key', 128)->nullable()->index();
            $table->unique(
                ['gateway', 'gateway_transaction_id'],
                'uniq_gateway_txid'
            );
            $table->softDeletes();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_transactions');
    }
};
