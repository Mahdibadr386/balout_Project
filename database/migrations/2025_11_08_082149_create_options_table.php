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
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->enum('type', ['two_option', 'multiple_option'])->nullable()->default('multiple_option');
            $table->string('name', 255);
            $table->decimal('effect', 8, 2)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['category_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};
