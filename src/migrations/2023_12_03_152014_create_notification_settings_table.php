<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notification_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('notification_settings');
    }
};
