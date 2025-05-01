@extends('layout.layout')
@section('content')

<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $title }}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $title }}</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">{{ $title }}</h4>
                            <a class="btn btn-primary btn-sm btn-round ml-auto" href="/transaksi">
                                <i class="fa fa-undo"></i>
                                Kembali
                            </a>
                        </div>
                        <hr/>
                        @foreach ($data_transaksi as $row)

                        <div class="row">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>No Transaksi</th>
                                            <td>: {{ $row->no_transaksi }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>Tgl Transaksi</th>
                                            <td>: {{ date('d/M/Y', strtotime($row->tgl_transaksi)) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>No</th>
                                    <th>Barang</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                                @php $no=1 @endphp
                                @foreach ($data_detail_transaksi as $d)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $d->nama_barang }}</td>
                                    <td>Rp. {{ number_format($d->harga) }}</td>
                                    <td>{{ $d->qty }}</td>
                                    <td>Rp. {{ number_format($d->harga * $d->qty) }}</td>
                                </tr>
                                @endforeach

                                <tr>
                                    <th colspan="4">Total</th>
                                    <th>Rp. {{ number_format($row->subtotal) }}</th>
                                </tr>
                                <tr>
                                    <th colspan="4">Diskon</th>
                                    <th>Rp. {{ number_format($row->diskon) }}</th>
                                </tr>
                                <tr>
                                    <th colspan="4">Total Bayar</th>
                                    <th>Rp. {{ number_format($row->total_bayar) }}</th>
                                </tr>
                                <tr>
                                    <th colspan="4">Uang Pembeli</th>
                                    <th>Rp. {{ number_format($row->uang_pembeli) }}</th>
                                </tr>
                                <tr>
                                    <th colspan="4">Kembalian</th>
                                    <th>Rp. {{ number_format($row->kembalian) }}</th>
                                </tr>
                            </table>
                        </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
