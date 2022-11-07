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
            //Primary Keys
            $table->primary(['user_id','likeable_type','likeable_id']);
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('likeable_id')->unsigned();
            $table->string('likeable_type');

            $table->foreign('user_id')->references('id')->on('users')
                ->cascadeOnDelete()->cascadeOnUpdate();
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
