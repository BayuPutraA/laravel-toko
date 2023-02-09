<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = ['id_transaksi','id_pembeli','id_barang','jumlah','tanggal','status','soft_delete'];

    public function Pembeli()
    {
        return $this->hasOne(Pembeli::class, 'id_pembeli', 'id_pembeli');
    }

    public function Barang()
    {
        return $this->hasOne(Barang::class, 'id_barang', 'id_barang');
    }
}
