<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('work_preferences', function (Blueprint $table) {
            $table->string('city')->nullable();
            $table->string('union');
            $table->string('member_since_year');
        });
    }

    public function down(): void
    {
        Schema::table('work_preferences', function (Blueprint $table) {
            //
        });
    }
};
