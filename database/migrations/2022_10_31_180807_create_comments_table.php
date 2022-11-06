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
            $table->id();
            //Foreign Keys
            $table->foreignId('user_id')->references('id')->on('users')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('post_id')->references('id')->on('posts')
            ->cascadeOnDelete()->cascadeOnUpdate();

            //Content of post
            $table->text('content');
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
