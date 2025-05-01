<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cetak Laporan</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body style="background-color: white;" onload="window.print()">

    <style>
    .line-title{
      border: 0;
      border-style: inset;
      border-top: 1px solid #000;
    }
  </style>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <img src="/assets/images/profile/profile.jpg" style="position: absolute; width: 200px; height: 75px;">
                    <table style="width: 100%;">
                        <tr>
                            <td align="center">
                                <span style="line-height: 1.6; font-weight: bold;">
                                    AlfaMaret
                                    <br>Jl.Kebon Jerok "Sky Terbaik di Situ"
                                    <br>Telp : 081999490052
                                </span>
                            </td>
                        </tr>
                    </table>

                    <hr class="line-title">
                    <p align="center">
                        <b>LAPORAN TRANSAKSI</b><br/>
                    </p>

                    <hr/>

                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>No Transaksi</th>
                            <th>Tgl Transaksi</th>
                            <th>Total Bayar</th>
                        </tr>

                        @php $no = 1 @endphp
                        @if($data_transaksi)
                        @foreach($data_transaksi as $row)

                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $row->no_transaksi }}</td>
                            <td>{{ date('d/M/Y', strtotime($row->tgl_transaksi)) }}</td>
                            <td>Rp. {{ number_format($row->total_bayar) }}</td>
                        </tr>

                        @endforeach

                        @else

                        <tr>
                            <td colspan="4"><center>Data Tidak Ada</center></td>
                        </tr>

                        @endif

                        @if($total_transaksi)

                        <tr>
                            <th colspan="3">Seluruh Total</th>
                            <th colspan="3">Rp. {{ number_format($total_transaksi) }}</th>
                        </tr>

                        @else

                        <tr>
                            <th colspan="3">Seluruh Total</th>
                            <th colspan="3">Rp. 0</th>
                        </tr>

                        @endif
                    </table>

                </div>
            </div>

        </div>
    </div>

</body>
</html>
