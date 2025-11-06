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
        Schema::create('media', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Polymorphic relation
            $table->unsignedBigInteger('model_id');
            $table->string('model_type');

            // File type (image or video)
            $table->enum('type', ['image', 'video'])->default('image')->index();

            // File information
            $table->string('collection_name', 100)->index(); // e.g., 'gallery', 'thumbnail', 'banner'
            $table->string('file_name', 255);
            $table->string('disk', 50)->default('public');
            $table->string('path', 255); // relative path
            $table->string('url', 500)->nullable(); // full URL for display
            $table->unsignedBigInteger('size')->nullable(); // file size in bytes

            // For videos
            $table->integer('duration')->nullable(); // duration in seconds (if applicable)

            // Metadata
            $table->json('custom_properties');

            // Display order
            $table->unsignedInteger('order_column')->nullable()->index();

            // Timestamps and soft deletes
            $table->timestamps();
            $table->softDeletes();

            // Composite index for faster polymorphic queries
            $table->index(['model_id', 'model_type']);
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
