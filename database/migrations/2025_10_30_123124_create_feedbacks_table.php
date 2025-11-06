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
        Schema::create('feedbacks', function (Blueprint $table) {
        $table->id();
        // Foreign keys
        $table->unsignedBigInteger('product_id');
        $table->unsignedBigInteger('user_id');

        // Comment content
        $table->text('comment');

        // Rating (1-5)
        $table->unsignedTinyInteger('rate');

        // Timestamps
        $table->timestamps();

        // Soft deletes for recoverable feedbacks
        $table->softDeletes();

        // Foreign key constraints
        $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        // Indexes for fast lookups
        $table->index('product_id');
        $table->index('user_id');
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
