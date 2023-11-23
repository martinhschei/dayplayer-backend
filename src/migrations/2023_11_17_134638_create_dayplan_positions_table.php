<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dayplan_positions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->smallInteger('count');
            $table->unsignedBigInteger('dayplan_id')->references('id')->on('dayplans')->onDelete('cascade');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('dayplan_positions');
    }
};
