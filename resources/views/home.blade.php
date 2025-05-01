@extends('layout.layout')
@section('content')

<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        @if (Auth::user()->role == 'admin')

        <div class="row">

            <div class="col-4">
                <div class="card card-widget">
                    <div class="card-body gradient-3">
                        <div class="media">
                            <span class="card-widget__icon"><i class="fa fa-briefcase"></i></span>
                            <div class="media-body">
                                <h2 class="card-widget__title">{{ $count_barang }}</h2>
                                <h5 class="card-widget__subtitle">Data Barang</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card card-widget">
                    <div class="card-body gradient-4">
                        <div class="media">
                            <span class="card-widget__icon"><i class="fa fa-desktop"></i></span>
                            <div class="media-body">
                                <h2 class="card-widget__title">{{ $count_transaksi }}</h2>
                                <h5 class="card-widget__subtitle">Data Transaksi</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card card-widget">
                    <div class="card-body gradient-9">
                        <div class="media">
                            <span class="card-widget__icon"><i class="fa fa-money"></i></span>
                            <div class="media-body">
                                <h2 class="card-widget__title">Rp. {{ number_format($pendapatan_today) }}</h2>
                                <h5 class="card-widget__subtitle">Pendapatan Hari Ini</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Data Stok Barang Menipis</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Jenis</th>
                                        <th>Stok</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($data_barang as $row)
                                    @if($row->stok < 10)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->nama_barang }}</td>
                                        <td>{{ $row->nama_jenis }}</td>
                                        <td>{{ $row->stok }} Pcs</td>
                                        <td>Rp. {{ number_format($row->harga) }}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card card-widget">
                    <div class="card-body gradient-1">
                        <div class="media">
                            <span class="card-widget__icon"><i class="fa fa-money"></i></span>
                            <div class="media-body">
                                <h2 class="card-widget__title">Rp. {{ number_format($seluruh_pendapatan) }}</h2>
                                <h5 class="card-widget__subtitle">Seluruh Pendapatan</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endif

        @if (Auth::user()->role == 'kasir')

        <div class="row">

            <div class="col-4">
                <div class="card card-widget">
                    <div class="card-body gradient-3">
                        <div class="media">
                            <span class="card-widget__icon"><i class="fa fa-desktop"></i></span>
                            <div class="media-body">
                                <h2 class="card-widget__title">{{ $transaksi_today }}</h2>
                                <h5 class="card-widget__subtitle">Transaksi Hari Ini</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card card-widget">
                    <div class="card-body gradient-4">
                        <div class="media">
                            <span class="card-widget__icon"><i class="fa fa-desktop"></i></span>
                            <div class="media-body">
                                <h2 class="card-widget__title">{{ $count_transaksi }}</h2>
                                <h5 class="card-widget__subtitle">Data Transaksi</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card card-widget">
                    <div class="card-body gradient-9">
                        <div class="media">
                            <span class="card-widget__icon"><i class="fa fa-money"></i></span>
                            <div class="media-body">
                                <h2 class="card-widget__title">Rp. {{ number_format($pendapatan_today) }}</h2>
                                <h5 class="card-widget__subtitle">Pendapatan Hari Ini</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-7">
                <div class="card">
                    <div class="card-body">
                        <canvas id="barChart"></canvas>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
                        <script>
                            (function () {
                              var ctx = document.getElementById("barChart");

                              var datas = {
                                labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
                                datasets: [
                                  {
                                    label: "Data Transaksi Perbulan Dan Tahun Ini",
                                    data: [
                                            {{ $januari }},
                                            {{ $febuari }},
                                            {{ $maret }},
                                            {{ $april }},
                                            {{ $mei }},
                                            {{ $juni }},
                                            {{ $juli }},
                                            {{ $agustus }},
                                            {{ $september }},
                                            {{ $oktober }},
                                            {{ $november }},
                                            {{ $desember }}
                                          ],
                                    backgroundColor: ['red','green','blue','yellow','black','gray','pink','purple','brown','orange','peach','navy'],
                                    borderColor: ['red','green','blue','yellow','black','gray','pink','purple','brown','orange','peach','navy'],
                                  }
                                ]
                              };

                              var options = {
                                responsive: true,
                                hover: {
                                  mode: 'label',
                                }
                              };

                              var chr = new Chart(ctx, {
                                data: datas,
                                type: "bar",
                                options: options
                              });
                            })();
                          </script>

                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card card-widget">
                    <div class="card-body gradient-1">
                        <div class="media">
                            <span class="card-widget__icon"><i class="fa fa-money"></i></span>
                            <div class="media-body">
                                <h2 class="card-widget__title">Rp. {{ number_format($seluruh_pendapatan) }}</h2>
                                <h5 class="card-widget__subtitle">Seluruh Pendapatan</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endif

    </div>
</div>

@endsection
