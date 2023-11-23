<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dayplan_positions', function (Blueprint $table) {
            $table->unsignedBigInteger('dayplan_position_group_id')->references('id')->on('dayplan_position_groups')->onDelete('cascade');
        });
    }
    
    public function down(): void
    {
        //
    }
};
