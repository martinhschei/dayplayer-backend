<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_profile_matches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profile_id');
            $table->unsignedBigInteger('department_job_id');
            $table->timestamps();
            
            $table->foreign('profile_id')
                    ->references('id')
                    ->on('profiles')
                    ->onDelete('cascade');

            $table->foreign('department_job_id')
                    ->references('id')
                    ->on('department_jobs')
                    ->onDelete('cascade');

            $table->unique(['profile_id', 'department_job_id'], 'profile_job_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_profile_matches');
    }
};