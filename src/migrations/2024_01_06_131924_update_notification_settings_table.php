<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notification_settings', function (Blueprint $table) {
            // $table->timestamp('used_at')->nullable();
            $table->dropColumn('notify_on_new_offers');
            $table->dropColumn('notify_on_offer_updates');
            $table->boolean('notify_on_job_offer_updates')->default(true);
            
            $table->boolean('notify_on_booking_updates')->default(true);
            $table->boolean('notify_on_payment_updates')->default(true);
        });
    }

    public function down(): void
    {
        //
    }
};
