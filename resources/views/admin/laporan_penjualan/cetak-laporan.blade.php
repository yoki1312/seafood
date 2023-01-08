<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pembelian</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }

    </style>
    <center>
        <h5>Laporan Transaksi</h4>
            <h6>{{ $header->kode_transaksi }}</h6>
        </h5>
    </center>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th class="text-center" scope="col">No</th>
                <th class="text-center" scope="col">Nama Toko</th>
                <th class="text-center" scope="col">Produk</th>
                <th class="text-center" scope="col">Kode Produk</th>
                <th class="text-center" scope="col">Nama Produk</th>
                <th class="text-center" scope="col">Harga Satuan</th>
                <th class="text-center" scope="col">Qty</th>
                <th class="text-center" scope="col">Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @php
            $total_qty = $total_harga =0;
            $no = 1;
            @endphp
            @foreach($data as $k)
            <tr>
                <td class="text-center">{{$no++}}</td>
                <td>{{$k->nama_toko}}</td>
                <td>{{$k->kode_barang}}</td>
                <td>{{$k->kode_barang}}</td>
                <td>{{$k->nama_barang}}</td>
                <td class="text-right">{{ number_format($k->harga_barang,0)     }}</td>
                <td class="text-right">{{abs($k->qty)}}</td>
                <td class="text-right">{{number_format($k->harga_barang * abs($k->qty),0)}}</td>
            </tr>
            @php
            $total_qty += abs($k->qty);
            $total_harga += $k->harga;
            @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5">Total</th>
                <th class="text-right">{{ number_format($total_harga,0)     }}</th>
                <th class="text-right">{{abs($total_qty)}}</th>
                <th class="text-right">{{number_format($total_harga * $total_qty,0)}}</th>
            </tr>
        </tfoot>
    </table>

</body>

</html>
