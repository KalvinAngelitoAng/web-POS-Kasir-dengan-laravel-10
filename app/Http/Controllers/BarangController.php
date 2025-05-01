<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\JenisBarang;

class BarangController extends Controller
{
    public function index()
    {
        $data = array(
            'title'       => 'Data Barang',
            'data_jenis'  => JenisBarang::all(),
            'data_barang' => Barang::join('tbl_jenis_barang', 'tbl_jenis_barang.id', '=', 'tbl_barang.id_jenis')
                                   ->select('tbl_barang.*', 'tbl_jenis_barang.nama_jenis')
                                   ->get(),
        );

        return view('admin.master.barang.list',$data);
    }

    public function store(Request $request)
    {
        Barang::create([
            'id_jenis'    => $request->id_jenis,
            'nama_barang' => $request->nama_barang,
            'harga'       => $request->harga,
            'stok'        => $request->stok,
        ]);

        return redirect('/barang')->with('success', 'Data Berhasil Disimpan');
    }

    public function update(Request $request, $id)
    {
        Barang::where('id', $id)
          ->where('id', $id)
            ->update([
                'id_jenis'    => $request->id_jenis,
                'nama_barang' => $request->nama_barang,
                'harga'       => $request->harga,
                'stok'        => $request->stok,
          ]);

        return redirect('/barang')->with('success', 'Data Berhasil Di Ubah');
    }

    public function destroy($id)
    {
        Barang::where('id', $id)->delete();
        return redirect('/barang')->with('success', 'Data Berhasil Dihapus');
    }
}
