<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class LaporanController extends Controller
{
    public function index()
    {
        $data = array(
            'title'          => 'Data Laporan',
            'data_transaksi' => Transaksi::all(),
        );

        return view('admin.laporan.list',$data);
    }

    public function cetak(Request $request)
    {
        $tgl_mulai   = $request->tgl_mulai;
        $tgl_selesai = $request->tgl_selesai;

        $data = array(
            'title'          => 'Cetak Laporan',
            'data_transaksi' => Transaksi::whereBetween('tgl_transaksi', [$tgl_mulai, $tgl_selesai])->get(),
            'total_transaksi'=> Transaksi::whereBetween('tgl_transaksi', [$tgl_mulai, $tgl_selesai])->sum('total_bayar'),
        );

        return view('admin.laporan.cetak',$data);
    }
}
