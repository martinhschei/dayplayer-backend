<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {  
        Schema::table('work_preferences', function (Blueprint $table) {
            $table->renameColumn('unavailable_in_weekends', 'available_in_weekends');
        });
    }
    
    public function down(): void
    {
        Schema::table('work_preferences', function (Blueprint $table) {
            //
        });
    }
};
