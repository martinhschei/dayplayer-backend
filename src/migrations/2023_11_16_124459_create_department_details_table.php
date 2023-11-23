<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('department_details', function (Blueprint $table) {
            $table->id();
            $table->string('zip');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->json('positions');
            $table->string('apt_suite');
            $table->string('street_address');
            $table->unsignedBigInteger('department_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('department_details');
    }
};
