<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            //Primary Key
            $table->id();

            //Foreign Key
            $table->foreignId('user_id')->references('id')->on('users')
                ->cascadeOnDelete()->cascadeOnUpdate();

            //Content of post
            $table->string("content");

            //Created and Updated timestamp attributes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
