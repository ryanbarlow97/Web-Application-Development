<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikeablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('likeables', function (Blueprint $table) {
            //Primary Key
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('likeable_id');
            $table->string('likeable_type');
            $table->timestamps();
            //make sure the user only likes the same post/comment once
            $table->unique(['user_id', 'likeable_type', 'likeable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('likeables');
    }
};
