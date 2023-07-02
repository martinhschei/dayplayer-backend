<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('method');
            $table->datetime('due_date');
            $table->unsignedBigInteger('amount');
            $table->datetime('paid_date')->nullable();
            $table->unsignedBigInteger('production_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
