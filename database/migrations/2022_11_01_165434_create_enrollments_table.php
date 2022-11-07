<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollmentsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('enrollments', function (Blueprint $table) {
           //Primary Keys
           $table->primary(['user_id', 'module_id']);
           $table->bigInteger('user_id')->unsigned();
           $table->bigInteger('module_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('module_id')->references('id')->on('modules')
                ->cascadeOnDelete()->cascadeOnUpdate();  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('enrollments');
    }
};
