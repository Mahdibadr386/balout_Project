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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->text('description')->nullable();

            $table->enum('scope', ['product', 'category', 'order', 'personal'])->default('order');

            $table->unsignedBigInteger('discountable_id')->nullable();
            $table->string('discountable_type')->nullable();

            $table->enum('type', ['amount', 'percent'])->default('amount');
            $table->unsignedInteger('value');
            $table->unsignedInteger('max_amount')->nullable();

            $table->boolean('is_personal')->default(false);

            $table->timestamp('starts_at');
            $table->timestamp('ends_at');

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
