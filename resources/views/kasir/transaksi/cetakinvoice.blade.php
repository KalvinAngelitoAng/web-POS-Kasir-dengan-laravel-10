<html>
    <head>
        <title>Cetak Invoice</title>
        <style>
        #tabel
        {
            ont-size:15px;
            border-collapse:collapse;
        }
        #tabel  td
        {
            padding-left:5px;
            border: 1px solid black;
        }
        </style>
    </head>
    <body style='font-family:tahoma; font-size:10pt;' onload="window.print()">
        @foreach ($data_transaksi as $row)

        <center>
            <table style='width:550px; font-size:10pt; font-family:calibri; border-collapse: collapse;' border = '0'>
                <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                    <span style='font-size:12pt'>
                        <b>AlfaMaret</b>
                    </span></br>
                    Jl.Kebon Jerok "Sky Terbaik di Situ" </br>
                    Telp : 081999490052
                </td>
                <td style='vertical-align:top' width='30%' align='left'>
                    <b><span style='font-size:12pt'>INVOICE PENJUALAN</span></b></br>
                    No Trans. : {{ $row->no_transaksi }}</br>
                    Tanggal : {{ date('d/M/Y', strtotime($row->tgl_transaksi)) }}</br>
                </td>
            </table>
            <br/>
            <table cellspacing='0' style='width:550px; font-size:10pt; font-family:calibri;  border-collapse: collapse;' border='1'>
                <tr align='center'>
                    <td width='25%'>Nama Barang</td>
                    <td width='15%'>Harga</td>
                    <td width='6%'>Qty</td>
                    <td width='20%'>Subtotal</td>
                </tr>

                @foreach ($data_detail_transaksi as $d)
                <tr>
                    <td>{{ $d->nama_barang }}</td>
                    <td>Rp. {{ number_format($d->harga) }}</td>
                    <td>{{ $d->qty }}</td>
                    <td style='text-align:right'>Rp. {{ number_format($d->harga * $d->qty) }}</td>
                </tr>
                @endforeach

                <tr>
                    <td colspan = '3'><div style='text-align:right'>Total : </div></td>
                    <td style='text-align:right'>Rp. {{ number_format($row->subtotal) }}</td>
                </tr>
                <tr>
                    <td colspan = '3'><div style='text-align:right'>Diskon : </div></td>
                    <td style='text-align:right'>Rp. {{ number_format($row->diskon) }}</td>
                </tr>
                <tr>
                    <td colspan = '3'><div style='text-align:right'>Total Yang Harus Dibayar : </div></td>
                    <td style='text-align:right'>Rp. {{ number_format($row->total_bayar) }}</td>
                </tr>
                <tr>
                    <td colspan = '3'><div style='text-align:right'>Cash : </div></td>
                    <td style='text-align:right'>Rp. {{ number_format($row->uang_pembeli) }}</td>
                </tr>
                <tr>
                    <td colspan = '3'><div style='text-align:right'>Kembalian : </div></td>
                    <td style='text-align:right'>Rp. {{ number_format($row->kembalian) }}</td>
                </tr>
            </table>

            <br/>

            <table style='width:650; font-size:10pt;' cellspacing='2'>
                <tr>
                    <td align='center'>Diterima Oleh,</br></br></br></br><u>(............)</u></td>
                    <td style='border:1px solid black; padding:5px; text-align:left; width:30%'></td>
                    <td align='center'>TTD,</br></br></br></br><u>(...........)</u></td>
                </tr>
            </table>
        </center>

        @endforeach
</body>
</html>
