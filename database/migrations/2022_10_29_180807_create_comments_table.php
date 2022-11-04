<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            //Primary Key
            $table->id('ucid');
            //Foreign Key
            $table->foreignId('uuid')->references('uuid')->on('users')->cascadeOnDelete();
            $table->foreignId('upid')->references('upid')->on('posts')->cascadeOnDelete();
            //Content of comment
            $table->string('content');
            $table->integer('upvotes');
            $table->integer('downvotes');
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
        Schema::dropIfExists('comments');
    }
};
