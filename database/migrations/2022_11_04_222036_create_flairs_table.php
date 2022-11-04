<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flairs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('post_id')->references('id')->on('posts')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->morphs('flairable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flairs');
    }
};
