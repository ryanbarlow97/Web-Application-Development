<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            //Primary Key
            $table->id('urid');
            //Foreign Key
            $table->foreign('uuid')->references('uuid')->on('users')->cascadeOnDelete();
            $table->foreign('upid')->references('upid')->on('posts')->cascadeOnDelete();
            //Content of comment
            $table->string('content');
            $table->integer('upvotes');
            $table->integer('downvotes');
            //Created and Updated timestamp attributes
            $table->timestamps('created_at');
            $table->timestamps('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replies');
    }
};
