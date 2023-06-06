<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKinerjaUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kinerja_unit', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nilaiCapaian');
            $table->datetime('tahun');
            $table->string('unitCapaian');
            $table->string('deskripsi');
            $table->string('status');
            // $table->unsignedBigInteger('dokumens_id');
            $table->integer('unitkerja_id')->unsigned();
            $table->integer('renop_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('renop_id')
                ->references('id')->on('renop')
                ->onDelete('cascade');
        });

        Schema::create('bukti_kinerja', function (Blueprint $table) {
            $table->increments('id');
            $table->string('namaBukti');
            $table->string('lokDokBukti');
            $table->datetime('tahun');
            $table->string('deskripsi');
            $table->string('status');
            // $table->unsignedBigInteger('dokumens_id');
            $table->integer('unitkerja_id')->unsigned();
            $table->integer('renop_id')->unsigned();
            $table->integer('kinerjaUnit_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('kinerjaUnit_id')
                ->references('id')->on('kinerja_unit')
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
        Schema::dropIfExists('kinerja_units');
    }
}
