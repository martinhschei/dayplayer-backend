<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('production_billing_details', function (Blueprint $table) {
            $table->id();
            $table->string('zip');
            $table->string('city');
            $table->string('ccv');
            $table->string('state');
            $table->string('country');
            $table->string('apt_suite');
            $table->string('name_on_card');
            $table->string('street_address');
            $table->string('payment_method');
            $table->string('expiration_date');
            $table->string('credit_card_number');
            $table->unsignedBigInteger('production_id');    
            $table->unsignedBigInteger('price')->default(0);
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('production_billing_details');
    }
};
