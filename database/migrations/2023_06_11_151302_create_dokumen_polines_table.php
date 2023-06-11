<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenPolinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_polines', function (Blueprint $table) {
            $table->id();
            $table->integer('unitkerja_id')->unsigned();
            $table->timestamps();

            $table->foreign('unitkerja_id')
                ->references('id')->on('unitkerja')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dokumen_polines');
    }
}
