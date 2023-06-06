<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_audit', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('tahun');
            $table->string('periode');
            $table->datetime('tglAudit');
            $table->datetime('waktu');
            $table->string('status');
            // $table->unsignedBigInteger('dokumens_id');
            $table->integer('unitkerja_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });

        Schema::create('laporan_audit', function (Blueprint $table) {
            $table->increments('id');
            $table->string('standar');
            $table->string('kategoriTemuan');
            $table->string('uraianTemuan');
            $table->string('saranPerbaikan');
            $table->string('status');
            // $table->unsignedBigInteger('dokumens_id');
            $table->integer('audit_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('audit_id')
                ->references('id')->on('jadwal_audit')
                ->onDelete('cascade');
        });

        Schema::create('CAR', function (Blueprint $table) {
            $table->increments('id');
            $table->string('analisiPenyebabMasalah');
            $table->string('tindakanPenyelesaian');
            $table->string('tindakanPencegahan');
            $table->string('hasilPemeriksaan');
            $table->string('rekomendasi');
            $table->string('status');
            // $table->unsignedBigInteger('dokumens_id');
            $table->integer('laporanaudit_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('laporanaudit_id')
                ->references('id')->on('laporan_audit')
                ->onDelete('cascade');
        });

        Schema::create('tinjauan_manajemen', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('tahun');
            $table->datetime('tglTM');
            $table->datetime('waktuTM');
            $table->string('status');
            // $table->unsignedBigInteger('dokumens_id');
            $table->integer('audit_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('audit_id')
                ->references('id')->on('jadwal_audit')
                ->onDelete('cascade');
        });

        Schema::create('bahan_rapatTM', function (Blueprint $table) {
            $table->increments('id');
            $table->text('deskripsi');
            $table->string('status');
            // $table->unsignedBigInteger('dokumens_id');
            $table->integer('tm_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('tm_id')
                ->references('id')->on('tinjauan_manajemen')
                ->onDelete('cascade');
        });

        Schema::create('hasil_rapatTM', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subjek');
            $table->text('uraian');
            $table->text('hasilPembahasan');
            $table->string('status');
            // $table->unsignedBigInteger('dokumens_id');
            $table->integer('tm_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('tm_id')
                ->references('id')->on('tinjauan_manajemen')
                ->onDelete('cascade');
        });

        Schema::create('tindak_lanjutTM', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tindakLanjut');
            $table->string('PIC');
            $table->string('status');
            // $table->unsignedBigInteger('dokumens_id');
            $table->integer('hslrpt_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('hslrpt_id')
                ->references('id')->on('hasil_rapatTM')
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
        Schema::dropIfExists('jadwal_audits');
    }
}
