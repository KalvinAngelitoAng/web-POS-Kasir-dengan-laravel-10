<html>
    <head>
        <title>Faktur Pembayaran</title>
        <style>
            #tabel
            {
                font-size:15px;
                border-collapse:collapse;
            }
            #tabel  td
            {
                padding-left:5px;
                border: 1px solid black;
            }
        </style>
    </head>
    <body style='font-family:tahoma; font-size:8pt;' onload="window.print()">

        @foreach($data_transaksi as $row)

        <center>
        <table style='width:350px; font-size:16pt; font-family:calibri; border-collapse: collapse;' border = '0'>
            <td width='70%' align='CENTER' vertical-align:top'>
                <span style='color:black;'>
                <b>AlfaMaret</b></br>NPWP 1234</span></br></br>Jl.Kebon Jerok "Sky Terbaik di Situ"</span></br>
                <span style='font-size:12pt'>
                    No. : {{ $row->no_transaksi }}, {{ date('d/M/Y', strtotime($row->tgl_transaksi)) }} (customer), {{ date('H:i:s') }}
                </span></br>
            </td>
        </table>

        <style>
        hr {
            display: block;
            margin-top: 0.5em;
            margin-bottom: 0.5em;
            margin-left: auto;
            margin-right: auto;
            border-style: inset;
            border-width: 1px;
        }
        </style>
        <br/>
        <table cellspacing='0' cellpadding='0' style='width:350px; font-size:12pt; font-family:calibri;  border-collapse: collapse;' border='0'>
            <tr align='center'>
                <td width='10%'>Barang</td>
                <td width='15%'>Harga</td>
                <td width='4%'>Qty</td>
                <td width='18%'>Total</td>
                <tr>
                    <td colspan='5'><hr></td>
                </tr>
            </tr>

            @foreach ($data_detail_transaksi as $d)
            <tr>
                <td style='vertical-align:top'>{{ $d->nama_barang }}</td>
                <td style='vertical-align:top; text-align:right; padding-right:10px'>{{ number_format($d->harga) }}</td>
                <td style='vertical-align:top; text-align:right; padding-right:10px'>{{ $d->qty }}</td>
                <td style='text-align:right; vertical-align:top'>{{ number_format($d->harga * $d->qty) }}</td>
            </tr>
            @endforeach

            <tr>
                <td colspan='4'><hr></td>
            </tr>
            <tr>
                <td colspan = '3'>
                    <div style='text-align:right'>Total : </div>
                </td>
                <td style='text-align:right; font-size:16pt;'>
                    {{ number_format($row->subtotal) }}
                </td>
            </tr>
            <tr>
                <td colspan = '3'>
                    <div style='text-align:right; color:black'>Diskon : </div>
                </td>
                <td style='text-align:right; font-size:16pt; color:black'>
                    {{ number_format($row->diskon) }}
                </td>
            </tr>
            <tr>
                <td colspan = '3'>
                    <div style='text-align:right; color:black'>Total Bayar : </div>
                </td>
                <td style='text-align:right; font-size:16pt; color:black'>
                    {{ number_format($row->total_bayar) }}
                </td>
            </tr>
            <tr>
                <td colspan = '3'>
                    <div style='text-align:right; color:black'>Cash : </div>
                </td>
                <td style='text-align:right; font-size:16pt; color:black'>
                    {{ number_format($row->uang_pembeli) }}
                </td>
            </tr>
            <tr>
                <td colspan = '3'>
                    <div style='text-align:right; color:black'>Kembalian : </div>
                </td>
                <td style='text-align:right; font-size:16pt; color:black'>
                    {{ number_format($row->kembalian) }}
                </td>
            </tr>
        </table>

        @endforeach
        <br/>
        <table style='width:350; font-size:12pt;' cellspacing='2'>
            <tr>
                </br><td align='center'>****** ARIGATOU GOZAIMASU ******</br></td>
            </tr>
        </table>
    </center>

</body>
</html>
