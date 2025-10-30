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
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('name' , 255);
            $table->string('name_en' , 255)->nullable();
            $table->text('description')->nullable();
            $table->string('price_number' , 255)->nullable();
            $table->string('price_kilo' , 255)->nullable();
            $table->integer('price_discounted')->nullable();
            $table->string('unit' )->nullable();
            $table->unsignedBigInteger('rate');
            $table->integer('minimum_weight')->nullable();
            $table->integer('maximum_weight')->nullable();
            $table->integer('minimum_number')->nullable();
            $table->integer('maximum_number')->nullable();
            $table->integer('preparation_time')->nullable();
            $table->string('batch_id' , 255)->nullable();
            $table->boolean('available')->default(1);
            $table->string('avg_weight')->nullable();
            $table->string('matin_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');


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
