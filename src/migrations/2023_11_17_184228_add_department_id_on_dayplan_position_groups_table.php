<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dayplan_position_groups', function (Blueprint $table) {
            $table->unsignedBigInteger('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }
    
    public function down(): void
    {
        //
    }
};
