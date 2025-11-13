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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->index();
            $table->string('slug', 255)->unique();
            $table->text('description')->nullable();
            $table->decimal('price_base', 12, 2)->default(0);
            $table->unsignedTinyInteger('discount_percentage')->default(0);
            $table->string('unit', 50)->nullable();
            $table->unsignedInteger('quantity')->default(1);
            $table->unsignedInteger('minimum')->default(1);
            $table->unsignedInteger('maximum')->default(100);
            $table->unsignedInteger('preparation_time')->default(0);
            $table->boolean('available')->default(true)->index();
            $table->decimal('rate', 3, 2)->default(0.00);
            $table->string('batch_code', 100)->nullable();
            $table->string('matin_code', 100)->nullable();

            $table->unsignedBigInteger('category_id')->nullable()->index();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('set null');


            $table->softDeletes();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
