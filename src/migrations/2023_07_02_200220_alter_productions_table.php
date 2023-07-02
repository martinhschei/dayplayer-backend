<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('productions', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->dropColumn('payment_status');
            $table->dropColumn('payment_deadline');
        });
    }
    
    public function down(): void
    {
        //
    }
};
