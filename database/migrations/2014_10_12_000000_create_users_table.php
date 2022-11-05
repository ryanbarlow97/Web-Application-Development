<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

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
            //firstname / lastname
            $table->string('f_name');
            $table->string('l_name');
            $table->date('date_of_birth');
            //unique email
            $table->string('email')->unique();
            //string to support +44
            $table->string('mobile')->unique();
            $table->timestamp('email_verified_at')->nullable();
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