<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('production_jobs', function (Blueprint $table) {
            $table->id();
            $table->date('from_date');
            $table->date('to_date');
            $table->unsignedBigInteger('production_id');
            $table->string('location')->nullable();
            $table->position('string');
            $table->unsignedBigInteger('hourly_rate');
            $table->json('profile_matches');
            $table->unsignedBigInteger('booked_profile');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('production_jobs');
    }
};
