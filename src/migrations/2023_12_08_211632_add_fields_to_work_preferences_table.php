<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('work_preferences', function (Blueprint $table) {
            $table->string('bio', 500)->nullable();
            $table->string('imdb_link')->nullable();
            $table->json('last_positions')->nullable();
        });
    }
    
    public function down(): void
    {
        Schema::table('work_preferences', function (Blueprint $table) {
            //
        });
    }
};
