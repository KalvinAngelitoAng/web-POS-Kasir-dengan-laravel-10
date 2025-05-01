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
                            <button class="btn btn-primary btn-sm btn-round ml-auto" data-toggle="modal" data-target="#modalCreate">
                                <i class="fa fa-print"></i>
                                Cetak Data
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>Total Bayar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($data_transaksi as $row)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->no_transaksi }}</td>
                                        <td>{{ date('d/M/Y', strtotime($row->tgl_transaksi)) }}</td>
                                        <td>Rp. {{ number_format($row->total_bayar) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cetak {{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form method="POST" action="/laporan/cetak" target="_blank">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Tgl Mulai</label>
                    <input type="date" class="form-control" name="tgl_mulai" required>
                </div>

                <div class="form-group">
                    <label>Tgl Selesai</label>
                    <input type="date" class="form-control" name="tgl_selesai" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Cetak Data</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
