<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('productions', function (Blueprint $table) {
            $table->string('zip_code');
            $table->string('apt_suite');    
            $table->string('state_province');
            $table->string('street_address');
        });
    }

    public function down(): void
    {
        Schema::table('productions', function (Blueprint $table) {
            //
        });
    }
};
