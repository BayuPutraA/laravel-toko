<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->increments('id_detail_transaksi');
            $table->integer('id_transaksi')->unsigned()->nullable();
            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksi');
            $table->integer('id_barang')->unsigned()->nullable();
            $table->foreign('id_barang')->references('id_barang')->on('barang');
            $table->integer('jumlah');

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
        Schema::dropIfExists('detail_transaksi');
    }
}
