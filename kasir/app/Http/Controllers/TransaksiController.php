<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Barang;
use App\Models\Diskon;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = array(
            'title'          => 'Data Transaksi',
            'data_transaksi' => Transaksi::all(),
        );

        return view('kasir.transaksi.list',$data);
    }

    public function create()
    {
        $transaksi = Transaksi::select(DB::raw('RIGHT(tbl_transaksi.no_transaksi,3) as no_transaksi', FALSE))
                               ->orderBy('no_transaksi', 'DESC')
                               ->limit(1)
                               ->get();

        if($transaksi->count() <> 0){
            $data = $transaksi->first();
            $kode = intval($data->no_transaksi) + 1;
        }
        else{
            $kode = 1;
        }

        $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodetampil = "NT-".$batas;

        $data = array(
            'title'        => 'Creact Data Transaksi',
            'data_barang'  => Barang::all(),
            'data_diskon'  => Diskon::all(),
            'no_transaksi' => $kodetampil,
        );

        return view('kasir.transaksi.add',$data);
    }

    public function get_detail_barang(Request $request)
    {
        $id_barang = $request->id_barang;
        $data=array(
            'detail_barang'=> Barang::where('id', $id_barang)->get(),
        );

        return view('kasir/transaksi/ajax_barang',$data);
    }

    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);

        if($request->qty > $request->stok)
        {
            return redirect()->back()->with('error', 'Qty Lebih Dari Stok');
        }
        else
        {
            $cart[$request->id_barang] = [
                "id_barang"   => $request->id_barang,
                "nama_barang" => $request->nama_barang,
                "qty"         => $request->qty,
                "harga"       => $request->harga,
                "stok"        => $request->stok
            ];

            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Data Berhasil Ditambah');
        }
    }

    public function deleteCart($id)
    {
        if($id) {
            $cart = session()->get('cart');
            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Data Berhasil Dihapus');
        }
    }

    public function store(Request $request)
    {
        $no_transaksi = $request->no_transaksi;

        Transaksi::create([
            'no_transaksi'  => $request->no_transaksi,
            'tgl_transaksi' => $request->tgl_transaksi,
            'subtotal'      => $request->subtotal,
            'diskon'        => $request->diskon,
            'kembalian'     => $request->kembalian,
            'uang_pembeli'  => $request->uang_pembeli,
            'total_bayar'   => $request->total_bayar,
        ]);

        $cart = session()->get('cart');

        foreach($cart as $items){

            $id_barang = $items['id_barang'];
            $qty       = $items['qty'];

            DetailTransaksi::create([
                'no_transaksi' => $no_transaksi,
                'id_barang'    => $id_barang,
                'qty'          => $qty,
            ]);

            $barang = Barang::find($id_barang);
            $barang->stok -= $qty;

            $barang->save();
        }

        session()->forget('cart');
        return redirect('/transaksi')->with('success', 'Data Berhasil Disimpan');
    }

    // ======================= CETAK DATA ===============================

    public function detail($no_transaksi)
    {
        $data=array(
            'title'                 => 'Detail Data Transaksi',
            'data_transaksi'        => Transaksi::where('no_transaksi', $no_transaksi)->get(),
            'data_detail_transaksi' => Transaksi::join('tbl_detail_transaksi', 'tbl_transaksi.no_transaksi', '=', 'tbl_detail_transaksi.no_transaksi')
                                                ->join('tbl_barang', 'tbl_barang.id', '=', 'tbl_detail_transaksi.id_barang')
                                                ->select('tbl_transaksi.no_transaksi', 'tbl_detail_transaksi.qty', 'tbl_barang.nama_barang', 'tbl_barang.harga')
                                                ->where('tbl_transaksi.no_transaksi', $no_transaksi)
                                                ->get(),
        );

        return view('kasir/transaksi/detail',$data);
    }

    public function cetakfaktur($no_transaksi)
    {
        $data=array(
            'title'                 => 'Cetak Faktur',
            'data_transaksi'        => Transaksi::where('no_transaksi', $no_transaksi)->get(),
            'data_detail_transaksi' => Transaksi::join('tbl_detail_transaksi', 'tbl_transaksi.no_transaksi', '=', 'tbl_detail_transaksi.no_transaksi')
                                                ->join('tbl_barang', 'tbl_barang.id', '=', 'tbl_detail_transaksi.id_barang')
                                                ->select('tbl_transaksi.no_transaksi', 'tbl_detail_transaksi.qty', 'tbl_barang.nama_barang', 'tbl_barang.harga')
                                                ->where('tbl_transaksi.no_transaksi', $no_transaksi)
                                                ->get(),
        );

        return view('kasir/transaksi/cetakfaktur',$data);
    }

    public function cetakinvoice($no_transaksi)
    {
        $data=array(
            'title'                 => 'Cetak Faktur',
            'data_transaksi'        => Transaksi::where('no_transaksi', $no_transaksi)->get(),
            'data_detail_transaksi' => Transaksi::join('tbl_detail_transaksi', 'tbl_transaksi.no_transaksi', '=', 'tbl_detail_transaksi.no_transaksi')
                                                ->join('tbl_barang', 'tbl_barang.id', '=', 'tbl_detail_transaksi.id_barang')
                                                ->select('tbl_transaksi.no_transaksi', 'tbl_detail_transaksi.qty', 'tbl_barang.nama_barang', 'tbl_barang.harga')
                                                ->where('tbl_transaksi.no_transaksi', $no_transaksi)
                                                ->get(),
        );

        return view('kasir/transaksi/cetakinvoice',$data);
    }
}
