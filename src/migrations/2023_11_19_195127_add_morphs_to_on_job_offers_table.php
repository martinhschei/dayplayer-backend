<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_offers', function (Blueprint $table) {
            $table->morphs('offerable');
        });
    }
    
    public function down(): void
    {
        Schema::table('job_offers', function (Blueprint $table) {
            $table->dropMorphs('offerable');
        });
    }
};
