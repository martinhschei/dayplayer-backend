<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dayplans', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('location');
            $table->string('time_of_day');
            $table->string('zip')->nullable();
            $table->text('notes')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('based_on')->nullable();
            $table->string('apt_suite')->nullable();
            $table->string('street_address')->nullable();
            $table->unsignedSmallInteger('number_of_stunts');
            $table->unsignedSmallInteger('number_of_actors');
            $table->unsignedSmallInteger('number_of_background');
            $table->unsignedBigInteger('dayplan_group_id')->nullable();
            $table->timestamps();
            
            $table->unsignedBigInteger('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dayplans');
    }
};
