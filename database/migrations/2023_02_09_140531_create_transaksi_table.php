<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('id_transaksi');
            $table->integer('id_pembeli')->unsigned()->nullable();
            $table->foreign('id_pembeli')->references('id_pembeli')->on('pembeli');
            $table->integer('id_barang')->unsigned()->nullable();
            $table->foreign('id_barang')->references('id_barang')->on('barang');
            $table->integer('jumlah_beli');
            $table->bigInteger('total_harga');
            $table->timestamp('tanggal')->useCurrent();
            $table->integer('status')->default(0);

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
        Schema::dropIfExists('transaksi');
    }
}
