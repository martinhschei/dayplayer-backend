<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordSetLinksTable extends Migration
{
    public function up()
    {
        Schema::create('password_set_links', function (Blueprint $table) {
            $table->id();
            $table->timestamp('expires_at');
            $table->unsignedBigInteger('user_id');
            $table->string('token', 64)->unique();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }   

    public function down()
    {
        Schema::dropIfExists('password_set_links');
    }
}
