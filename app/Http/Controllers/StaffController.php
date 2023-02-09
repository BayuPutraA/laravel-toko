<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembeli;
use App\Models\Barang;
use App\Models\Staff;
use App\Models\Transaksi;
use Carbon\Carbon;

class StaffController extends Controller
{
    public function dashboard(){
        $barang = Barang::where('soft_delete', 0)
            ->get();

        $all_terjual = 0;
        $all_keuntungan = 0;
        foreach($barang as $key => $b){
            $total_terjual = Transaksi::where('id_barang', $b->id_barang)
                ->where('status', 1)
                ->where('soft_delete', 0)
                ->sum('jumlah_beli');

            $barang[$key]['terjual'] = (int)$total_terjual;
            $keuntungan = ((int)$b->harga_jual - (int)$b->harga_beli) * (int)$total_terjual;

            $all_terjual += (int)$total_terjual;
            $all_keuntungan += (int)$keuntungan;
        }

        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek();
        $dataTerjualHarian = [];
        $dataKeuntunganHarian = [];

        for($i = 0; $i < 7; $i++){
            $terjual_harian = 0;
            $keuntungan_harian = 0;

            foreach($barang as $key => $b){
                $total_terjual = Transaksi::where('id_barang', $b->id_barang)
                    ->where('status', 1)
                    ->where('soft_delete', 0)
                    ->whereDate('tanggal', $weekStartDate->format('Y-m-d'))
                    ->sum('jumlah_beli');
    
                $keuntungan = ((int)$b->harga_jual - (int)$b->harga_beli) * (int)$total_terjual;

                $terjual_harian += (int) $total_terjual;
                $keuntungan_harian += (int) $keuntungan;
            }

            $dataTerjualHarian[$i] = (int)$terjual_harian;
            $dataKeuntunganHarian[$i] = (int)$keuntungan_harian;

            $weekStartDate = $weekStartDate->addDays();
        }

        return view('dashboard', [
            'barang' => $barang,
            'all_terjual' => $all_terjual,
            'all_keuntungan' => $all_keuntungan,
            'dataTerjualHarian' => $dataTerjualHarian,
            'dataKeuntunganHarian' => $dataKeuntunganHarian,
        ]);
    }

    public function barang(){
        $data = Barang::where('soft_delete', 0)
            ->orderBy('id_barang', 'DESC')
            ->get();

        return view('barang', ['data' => $data]);
    }

    public function tambahBarang(Request $request){
        $nama = $request->input('nama');
        $deskripsi = $request->input('deskripsi');
        $jenis = $request->input('jenis');
        $stock = $request->input('stock');
        $harga_beli = $request->input('harga_beli');
        $harga_jual = $request->input('harga_jual');
        $gambar = $request->file('gambar');

        $data = new Barang();
        $data->nama = $nama;
        $data->deskripsi = $deskripsi;
        $data->jenis = $jenis;
        $data->stock = $stock;
        $data->harga_beli = $harga_beli;
        $data->harga_jual = $harga_jual;

        $nama_file = time() . "_" . $gambar->getClientOriginalName();

        //isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'uploads/gambar/';
        //upload file
        $gambar->move($tujuan_upload, $nama_file);

        $data->gambar = $tujuan_upload . $nama_file;

        $data->save();
        return redirect('/barang');
    }

    public function editBarang(Request $request){
        $id_barang = $request->input('id_barang');
        $nama = $request->input('nama');
        $deskripsi = $request->input('deskripsi');
        $jenis = $request->input('jenis');
        $stock = $request->input('stock');
        $harga_beli = $request->input('harga_beli');
        $harga_jual = $request->input('harga_jual');
        $gambar = $request->file('gambar') ?? null;

        $data = Barang::find($id_barang);
        $data->nama = $nama;
        $data->deskripsi = $deskripsi;
        $data->jenis = $jenis;
        $data->stock = $stock;
        $data->harga_beli = $harga_beli;
        $data->harga_jual = $harga_jual;

        if($gambar){
            $nama_file = time() . "_" . $gambar->getClientOriginalName();

            //isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'uploads/gambar/';
            //upload file
            $gambar->move($tujuan_upload, $nama_file);

            $data->gambar = $tujuan_upload . $nama_file;
        }

        $data->save();
        return redirect('/barang');
    }

    public function hapusBarang($id){
        $data = Barang::find($id);
        $data->soft_delete = 1;
        
        $data->save();
        return redirect('/barang');
    }

    public function staff(){
        $data = Staff::where('soft_delete', 0)
            ->orderBy('id_staff', 'DESC')
            ->get();

        return view('staff', ['data' => $data]);
    }

    public function tambahStaff(Request $request){
        $nama = $request->input('nama');
        $jenis_kelamin = $request->input('jenis_kelamin');
        $username = $request->input('username');
        $password = $request->input('password');

        $data = new Staff();
        $data->nama = $nama;
        $data->jenis_kelamin = $jenis_kelamin;
        $data->username = $username;
        $data->password = $password;

        $data->save();
        return redirect('/staff');
    }

    public function editStaff(Request $request){
        $id_staff = $request->input('id_staff');
        $nama = $request->input('nama');
        $jenis_kelamin = $request->input('jenis_kelamin');
        $username = $request->input('username');
        $password = $request->input('password');

        $data = Staff::find($id_staff);
        $data->nama = $nama;
        $data->jenis_kelamin = $jenis_kelamin;
        $data->username = $username;
        $data->password = $password;

        $data->save();
        return redirect('/staff');
    }

    public function hapusStaff($id){
        $data = Staff::find($id);
        $data->soft_delete = 1;
        
        $data->save();
        return redirect('/staff');
    }

    public function pembeli(){
        $data = Pembeli::where('soft_delete', 0)
            ->orderBy('id_pembeli', 'DESC')
            ->get();

        return view('pembeli', ['data' => $data]);
    }

    public function tambahPembeli(Request $request){
        $nama = $request->input('nama');
        $ttl = $request->input('ttl');
        $jenis_kelamin = $request->input('jenis_kelamin');
        $alamat = $request->input('alamat');
        $username = $request->input('username');
        $password = $request->input('password');
        $foto_ktp = $request->file('foto_ktp');

        $data = new Pembeli();
        $data->nama = $nama;
        $data->ttl = $ttl;
        $data->jenis_kelamin = $jenis_kelamin;
        $data->alamat = $alamat;
        $data->username = $username;
        $data->password = $password;

        $nama_file = time() . "_" . $foto_ktp->getClientOriginalName();

        //isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'uploads/foto_ktp/';
        //upload file
        $foto_ktp->move($tujuan_upload, $nama_file);

        $data->foto_ktp = $tujuan_upload . $nama_file;

        $data->save();
        return redirect('/pembeli');
    }

    public function editPembeli(Request $request){
        $id_pembeli = $request->input('id_pembeli');
        $nama = $request->input('nama');
        $ttl = $request->input('ttl');
        $jenis_kelamin = $request->input('jenis_kelamin');
        $alamat = $request->input('alamat');
        $username = $request->input('username');
        $password = $request->input('password');
        $foto_ktp = $request->file('foto_ktp') ?? null;

        $data = Pembeli::find($id_pembeli);
        $data->nama = $nama;
        $data->ttl = $ttl;
        $data->jenis_kelamin = $jenis_kelamin;
        $data->alamat = $alamat;
        $data->username = $username;
        $data->password = $password;

        if($foto_ktp){
            $nama_file = time() . "_" . $foto_ktp->getClientOriginalName();
    
            //isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'uploads/foto_ktp/';
            //upload file
            $foto_ktp->move($tujuan_upload, $nama_file);
    
            $data->foto_ktp = $tujuan_upload . $nama_file;
        }

        $data->save();
        return redirect('/pembeli');
    }

    public function hapusPembeli($id){
        $data = Pembeli::find($id);
        $data->soft_delete = 1;
        
        $data->save();
        return redirect('/pembeli');
    }

    public function konfirmasi(){
        $data = Transaksi::where('soft_delete', 0)
            ->with('Barang', 'Pembeli')
            ->orderBy('id_transaksi', 'DESC')
            ->get();

        return view('konfirmasi', ['data' => $data]);
    }

    public function konfirmasiPembelian($id){
        $transaksi = Transaksi::find($id);
        $transaksi->status = 1;

        $barang = Barang::where('id_barang', $transaksi->id_barang)
            ->first();

        $stock_lama = $barang->stock;
        $stock_baru = (int)$stock_lama - (int)$transaksi->jumlah_beli;
        $barang->stock = $stock_baru;

        $barang->save();
        $transaksi->save();

        return redirect('/konfirmasi');
    }
}
