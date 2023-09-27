<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('department_jobs', function (Blueprint $table) {
            $table->id();
            $table->date('to_date');
            $table->date('from_date');
            $table->string('position');
            $table->string('location')->nullable();
            $table->unsignedBigInteger('hourly_rate');
            $table->unsignedBigInteger('department_id');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('production_jobs');
    }
};