<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->timestamps();
            
            $table->unsignedBigInteger('production_billing_details_id')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
