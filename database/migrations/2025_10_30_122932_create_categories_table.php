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
        Schema::create('categories', function (Blueprint $table) {
        $table->id();
        $table->string('name', 255);
        $table->string('slug', 255)->unique();
        $table->unsignedBigInteger('parent_id')->nullable()->index();
        $table->text('description')->nullable();
        $table->boolean('is_active')->default(true);
        $table->integer('sort_order')->default(0)->index();
        $table->timestamps();

        $table->unique(['parent_id', 'name']);
        $table->foreign('parent_id')->references('id')->on('categories')->onDelete('set null');
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
