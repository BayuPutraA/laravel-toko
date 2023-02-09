<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Barang;
use App\Models\Transaksi;

class PembeliController extends Controller
{
    public function market(){
        $data = Barang::where('soft_delete', 0)
            ->orderBy('id_barang', 'DESC')
            ->get();

        return view('market', ['data' => $data]);
    }

    public function beliBarang(Request $request){
        $id_barang = $request->input('id_barang');
        $jumlah_beli = $request->input('jumlah_beli');
        $total_harga = $request->input('total_harga');
        $id_pembeli = Session::get('id_pembeli');

        $data = new Transaksi();
        $data->id_pembeli = $id_pembeli;
        $data->id_barang = $id_barang;
        $data->jumlah_beli = $jumlah_beli;
        $data->total_harga = $total_harga;

        $data->save();
        return redirect('/history');
    }

    public function history(){
        $data = Transaksi::where('soft_delete', 0)
            ->where('id_pembeli', Session::get('id_pembeli'))
            ->with('Barang')
            ->orderBy('id_transaksi', 'DESC')
            ->get();

        return view('history', ['data' => $data]);
    }
}
