<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calendar_days', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('status');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('calendar_days');
    }
};
