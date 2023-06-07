<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('union')->nullable();
            $table->date('birthday')->nullable();
            $table->json('positions')->nullable();
            $table->string('bio', 1024)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('phone_number')->nullable();
            $table->boolean('available')->default(true);
            $table->date('union_member_since')->nullable();
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
