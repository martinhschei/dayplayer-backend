<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('account_setup_tokens', function (Blueprint $table) {
            $table->timestamp('used_at')->nullable();
        });
    }
    
    public function down(): void
    {
        //
    }
};
