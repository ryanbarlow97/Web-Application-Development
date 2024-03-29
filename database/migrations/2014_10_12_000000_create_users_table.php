<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration 
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            //unique user id
            $table->id();
            $table->string('user_name')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('date_of_birth');
            //unique email
            $table->string('email')->unique();
            $table->string('priority')->default('0');
            //string to support +44
            #$table->string('mobile')->unique();
            $table->string('profile_picture')->default('profile-picture/default_profile_picture.png');
            #$table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }
};