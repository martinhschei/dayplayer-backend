<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->json('job_offer_data');
            $table->unsignedBigInteger('dayplayer_id');
            $table->unsignedBigInteger('job_offer_id');
            $table->timestamps();
            
            $table->foreign('dayplayer_id')->references('id')->on('users');
            $table->foreign('job_offer_id')->references('id')->on('job_offers');
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
