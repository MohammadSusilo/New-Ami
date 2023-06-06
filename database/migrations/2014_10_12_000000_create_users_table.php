<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        // MASTER
        Schema::create('dokumenInduk', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->datetime('tahun_aktif');
            $table->datetime('tahun_selesai');
            $table->string('status');
            $table->string('lokasi');
            $table->timestamps();
        });

        Schema::create('pimpinan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('renstra', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode');
            $table->string('deskripsi');
            $table->Integer('target');
            $table->string('unit_target');
            $table->string('tipe_indikator');
            $table->datetime('tahun');
            $table->string('status');
            $table->string('referensi');
            // $table->unsignedBigInteger('dokumens_id');
            $table->integer('dokumen_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('dokumen_id')
                ->references('id')->on('dokumenInduk')
                ->onDelete('cascade');

        });

        Schema::create('pengelolaUnitKerja', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('status');
            $table->string('repo');
            // $table->unsignedBigInteger('pimpinan_id');
            // $table->integer('pimpinan_id')->unsigned();
            $table->timestamps();
            
            // $table->foreign('pimpinan_id')
            //     ->references('id')->on('pimpinan')
            //     ->onDelete('cascade');

        });

        Schema::create('unitKerja', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('status');
            // $table->unsignedBigInteger('pengelola_id');
            $table->integer('pengelola_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('pengelola_id')
                ->references('id')->on('pengelolaUnitKerja')
                ->onDelete('cascade');

        });

        Schema::create('renop', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode');
            $table->string('deskripsi');
            $table->Integer('target');
            $table->string('unit_target');
            $table->datetime('tahun');
            $table->string('status');
            // $table->unsignedBigInteger('unitkerja_id');
            $table->integer('unitkerja_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('unitkerja_id')
                ->references('id')->on('unitKerja')
                ->onDelete('cascade');

        });

        Schema::create('dokumencheklist', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('tahun');
            $table->string('lokasi');
            $table->string('status');
            // $table->unsignedBigInteger('unitkerja_id');
            $table->integer('unitkerja_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('unitkerja_id')
                ->references('id')->on('unitKerja')
                ->onDelete('cascade');

        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('desc');
            $table->boolean('status')->nullable();
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('role_id')->unsigned();
            $table->integer('unitkerja_id')->unsigned()->nullable();
            $table->boolean('status');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_id')
                ->references('id')->on('roles')
                ->onDelete('cascade');

            $table->foreign('unitkerja_id')
                ->references('id')->on('unitKerja')
                ->onDelete('cascade');

        });

        Schema::create('profile', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('jabatan');
            $table->string('foto');
            $table->string('status');
            // $table->unsignedBigInteger('user_id');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

        });

        Schema::create('renop_renstra', function (Blueprint $table) {
            // $table->unsignedBigInteger('renop_id');
            $table->increments('id');
            $table->integer('renop_id')->unsigned();
            $table->foreign('renop_id')
                ->references('id')->on('renop')
                ->onDelete('cascade');

            // $table->unsignedInteger('renstra_id');
            $table->integer('renstra_id')->unsigned();
            $table->foreign('renstra_id')
                ->references('id')->on('renstra')
                ->onDelete('cascade');
        });


        Schema::create('pengelola_pimpinan', function (Blueprint $table) {
            // $table->unsignedBigInteger('pimpinan_id');
            $table->increments('id');
            $table->integer('pimpinan_id')->unsigned();
            $table->foreign('pimpinan_id')
            ->references('id')->on('pimpinan')
                ->onDelete('cascade');

            // $table->unsignedInteger('pengelola_id');
            $table->integer('pengelola_id')->unsigned();
            $table->foreign('pengelola_id')
                ->references('id')->on('pengelolaUnitKerja')
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
        Schema::dropIfExists('dokumeninduk');
        Schema::dropIfExists('pimpinan');
        Schema::dropIfExists('renstra');
        Schema::dropIfExists('renop_renstra');
        Schema::dropIfExists('pengelola_pimpinan');
        Schema::dropIfExists('renop');
        Schema::dropIfExists('pengelolaunitkerja');
        Schema::dropIfExists('dokumencheklist');
        Schema::dropIfExists('unitkerja');
        Schema::dropIfExists('profile');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('users');
    }
}
