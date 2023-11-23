<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dayplan_positions', function (Blueprint $table) {
            $table->unsignedBigInteger('dayplan_position_group_id')->nullable()->change();
        });
    }
        
    public function down(): void
    {
        Schema::table('dayplan_positions', function (Blueprint $table) {
            //
        });
    }
};
