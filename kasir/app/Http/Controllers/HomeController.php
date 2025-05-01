<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Barang;

class HomeController extends Controller
{
    public function index()
    {
        $now  = date('Y-m-d');
        $year = date('Y');

        $data = array(
            'title'              => 'Home Page',
            'count_barang'       => Barang::count(),
            'count_transaksi'    => Transaksi::count(),
            'pendapatan_today'   => Transaksi::where('tgl_transaksi', $now)->sum('total_bayar'),
            'data_barang'        => Barang::join('tbl_jenis_barang', 'tbl_jenis_barang.id', '=', 'tbl_barang.id_jenis')
                                          ->select('tbl_barang.*', 'tbl_jenis_barang.nama_jenis')
                                          ->get(),
            'transaksi_today'    => Transaksi::where('tgl_transaksi', $now)->count(),
            'seluruh_pendapatan' => Transaksi::sum('total_bayar'),

            'januari'   => Transaksi::whereMonth('tgl_transaksi', '=', '01')->whereYear('tgl_transaksi', '=', $year)->count(),
            'febuari'   => Transaksi::whereMonth('tgl_transaksi', '=', '02')->whereYear('tgl_transaksi', '=', $year)->count(),
            'maret'     => Transaksi::whereMonth('tgl_transaksi', '=', '03')->whereYear('tgl_transaksi', '=', $year)->count(),
            'april'     => Transaksi::whereMonth('tgl_transaksi', '=', '04')->whereYear('tgl_transaksi', '=', $year)->count(),
            'mei'       => Transaksi::whereMonth('tgl_transaksi', '=', '05')->whereYear('tgl_transaksi', '=', $year)->count(),
            'juni'      => Transaksi::whereMonth('tgl_transaksi', '=', '06')->whereYear('tgl_transaksi', '=', $year)->count(),
            'juli'      => Transaksi::whereMonth('tgl_transaksi', '=', '07')->whereYear('tgl_transaksi', '=', $year)->count(),
            'agustus'   => Transaksi::whereMonth('tgl_transaksi', '=', '08')->whereYear('tgl_transaksi', '=', $year)->count(),
            'september' => Transaksi::whereMonth('tgl_transaksi', '=', '09')->whereYear('tgl_transaksi', '=', $year)->count(),
            'oktober'   => Transaksi::whereMonth('tgl_transaksi', '=', '10')->whereYear('tgl_transaksi', '=', $year)->count(),
            'november'  => Transaksi::whereMonth('tgl_transaksi', '=', '11')->whereYear('tgl_transaksi', '=', $year)->count(),
            'desember'  => Transaksi::whereMonth('tgl_transaksi', '=', '12')->whereYear('tgl_transaksi', '=', $year)->count(),
        );

        return view('home',$data);
    }
}
