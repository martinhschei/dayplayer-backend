<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->string('body', 250);
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('conversation_id');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
    }
};
