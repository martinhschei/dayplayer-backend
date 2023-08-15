<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('conversation_profile', function (Blueprint $table) {
            $table->unsignedBigInteger('last_message_seen_id')->nullable();
        });
    }
    
    public function down(): void
    {
        Schema::table('conversation_profile', function (Blueprint $table) {
            $table->dropColumn('last_message_seen_id');
        });
    }
};
