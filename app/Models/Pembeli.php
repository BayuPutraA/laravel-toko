<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    protected $table = 'pembeli';
    protected $primaryKey = 'id_pembeli';
    protected $fillable = ['id_pembeli','ttl','jenis_kelamin','alamat','foto_ktp','username','password','soft_delete'];
}
