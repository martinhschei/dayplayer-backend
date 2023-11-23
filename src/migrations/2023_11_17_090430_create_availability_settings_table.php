<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('availability_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date('pause_end')->nullable();
            $table->date('pause_start')->nullable();
            $table->boolean('available')->default(true);
            $table->boolean('notify_by_sms')->default(false);
            $table->boolean('notify_by_email')->default(true);
            $table->boolean('notify_on_new_offers')->default(true);
            $table->boolean('notify_on_offer_updates')->default(true);
            $table->boolean('notify_on_new_chat_messages')->default(true);
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('availability_settings');
    }
};
