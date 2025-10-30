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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_admin')->default(0);
            $table->boolean('is_active')->default(1);
            $table->string('password', 255)->nullable();
            $table->string('first_name', 255)->nullable();
            $table->string('last_name', 255)->nullable();
            $table->string('name_en', 255)->nullable();
            $table->string('tel', 255)->nullable();
            $table->string('national_code', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('code', 255)->nullable();
            $table->date('birth_date')->nullable();
            $table->date('marriage_date')->nullable();
            $table->date('last_login_date')->nullable();

            $table->softDeletes();
            $table->timestamps();

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
