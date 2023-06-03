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
            $table->string('union');
            $table->date('birthday');
            $table->json('positions');
            $table->string('phone_number');
            $table->unsignedBigInteger('user_id');
            $table->boolean('available')->default(true);
            $table->string('bio', 1024)->nullable();
            $table->date('union_member_since')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
