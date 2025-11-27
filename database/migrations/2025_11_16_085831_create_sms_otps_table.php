<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('sms_otps', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number')->index();
            $table->string('otp', 10);
            $table->timestamp('expires_at')->index();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sms_otps');
    }
};
