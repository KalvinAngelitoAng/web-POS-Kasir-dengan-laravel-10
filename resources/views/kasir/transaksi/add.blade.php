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
                    <form method="POST" action="/transaksi/store">
                    @csrf
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">{{ $title }}</h4>
                        </div>
                        <hr/>
                        
                        <a href="{{ route('member.create') }}" class="btn btn-sm btn-success">
                            <i class="fa fa-plus"></i> Tambah Member
                        </a>
                        <hr/>
                        <div class="form-group">
                            <label for="id_member">ID Member</label>
                            <input type="text" name="id_member" id="id_member" class="form-control" placeholder="Masukkan ID Member">
                        </div>
                        
                        <hr/>
                        <button class="btn btn-sm btn-primary" type="button" data-target="#modalCreate" data-toggle="modal">
                            <i class="fa fa-plus"></i> Tambah Data
                        </button>
                        <hr/>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>No</th>
                                    <th>Barang</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>

                                @php $no = 1; $total = 0; @endphp
                                @if(session('cart'))
                                @foreach(session('cart') as $items)
                                @php $total += $items['harga'] * $items['qty'] @endphp
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $items['nama_barang'] }}</td>
                                        <td>{{ number_format($items['harga']) }}</td>
                                        <td>{{ $items['qty'] }}</td>
                                        <td>{{ number_format($items['qty'] * $items['harga'])  }}</td>
                                        <td>
                                            <a onclick="return confirm('Hapus Data Ini ?');" href="/transaksi/deleteCart/{{ $items['id_barang'] }}" class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif

                                <tr>
                                    <td colspan="4">Total</td>
                                    <td>
                                        Rp. {{ number_format($total) }}
                                        <input type="hidden" name="subtotal" value="{{ $total }}">
                                    </td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td colspan="4">Diskon</td>
                                    <td>
                                        @foreach ($data_diskon as $d)
                                        @php $diskon = $d->diskon/100 * $total; $total_belanja = $d->total_belanja; @endphp

                                        @if($total > $total_belanja)
                                            Rp. {{ number_format($diskon) }}
                                            <input type="hidden" name="diskon" id="diskon" value="{{ $diskon }}">
                                        @else
                                            Rp. 0
                                            <input type="hidden" name="diskon" id="diskon" value="0">
                                        @endif

                                        @endforeach
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="4">Seluruh Total</td>
                                    <td>
                                        @php $seluruh_total = $total - $diskon; @endphp

                                        @if($total > $total_belanja)
                                            Rp. {{ number_format($seluruh_total) }}
                                            <input type="hidden" name="total_bayar" id="total_bayar" value="{{ $seluruh_total }}">
                                        @else
                                            Rp. {{ number_format($total) }}
                                            <input type="hidden" name="total_bayar" id="total_bayar" value="{{ $total }}">
                                        @endif
                                    </td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No Transaksi</label>
                                    <input type="text" value="{{ $no_transaksi }}" class="form-control" name="no_transaksi" readonly required>
                                </div>
                                <div class="form-group">
                                    <label>Tgl Transaksi</label>
                                    <input type="text" class="form-control" value="{{ date('d/M/Y') }}" readonly required>
                                    <input type="hidden" name="tgl_transaksi" class="form-control" value="{{ date('Y-m-d') }}" readonly required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Uang Pembeli</label>
                                    <input type="number" class="form-control" id="uang_pembeli" placeholder="Uang Pembeli ..." name="uang_pembeli" required>
                                </div>
                                <div class="form-group">
                                    <label>Kembalian</label>
                                    <input type="text" class="form-control"  name="kembalian" id="kembalian" placeholder="Kembalian ..." readonly required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
                        <a href="/transaksi" class="btn btn-danger"><i class="fa fa-undo"></i> Cancel</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create {{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form method="POST" action="/transaksi/addToCart">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Jenis Barang</label>
                    <select class="form-control" name="id_barang" id="id_barang" required>
                        <option value="" hidden>-- Pilih Nama Barang --</option>
                        @foreach ($data_barang as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_barang }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="tampil_barang"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
