<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('password_reset_tokens', function (Blueprint $table) {
            $table->renameColumn('created_at', 'updated_at');
        });
    }
    
    public function down(): void
    {
        Schema::table('password_reset_tokens', function (Blueprint $table) {
            //
        });
    }
};
