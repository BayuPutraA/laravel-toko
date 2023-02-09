<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembeliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembeli', function (Blueprint $table) {
            $table->increments('id_pembeli');
            $table->string('nama');
            $table->string('ttl');
            $table->string('jenis_kelamin');
            $table->string('alamat');
            $table->string('foto_ktp');
            $table->string('username');
            $table->string('password');
            $table->string('retype_password');

            $table->smallInteger('soft_delete')->default(0);
            $table->timestamps(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembeli');
    }
}
