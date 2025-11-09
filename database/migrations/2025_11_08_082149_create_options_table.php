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
            $table->unsignedBigInteger('optionable_id');
            $table->string('optionable_type', 255)->nullable();
            $table->enum('type', ['two_option', 'multiple_option'])->nullable();
            $table->string('name', 255);
            $table->decimal('effect', 8, 2)->nullable();
            $table->unsignedBigInteger('parent_id')->nullable()->index();
            $table->softDeletes();
            $table->timestamps();


            $table->index(['optionable_id', 'optionable_type']);
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
