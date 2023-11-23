<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dayplans', function (Blueprint $table) {
            $table->dropColumn('dayplan_group_id');
        });
    }
    
    public function down(): void
    {
        //
    }
};
