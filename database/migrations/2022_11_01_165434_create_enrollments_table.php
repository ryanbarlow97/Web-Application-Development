<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('enrollments', function (Blueprint $table) {
            //Primary Key
            $table->id();
            //Foreign Keys
            $table->foreignId('user_id')->references('id')->on('users')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('module_id')->references('id')->on('modules')
            ->cascadeOnDelete()->cascadeOnUpdate();  

            //make sure the user only enrolls to the same module once
            $table->unique(['user_id', 'module_id']);
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
