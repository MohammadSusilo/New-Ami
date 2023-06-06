<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('level');
            $table->integer('master');
            $table->string('url');
            $table->string('icon')->nullable();
            // $table->foreignId('role_id')->unsigned();
            $table->string('role_id')->references('id')->on('roles');
            // $table->string('role_id')->unsigned();
            $table->string('sorting');
            $table->boolean('status')->nullable();
            $table->timestamps();

            // $table->foreign('role_id')
            //     ->references('id')->on('roles')
            //     ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
