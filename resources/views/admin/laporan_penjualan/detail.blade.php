@extends('admin.template_index')
@section('template_index')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detail Laporan Transaksi</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Detail Laporan Transaksi</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <input hidden type="text" class="id_trans" value="{{$header->id_transaksi}}"/>
                        <h4>{{$header->kode_transaksi}} <small class="float-right">Date: {{date('d/m/Y', strtotime($header->tanggal_transaksi))}}</small></h4>
                    </div>
                </div>
                <hr>
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <p>Pembeli</p>
                        <strong>{{$header->nama_pembeli}}</strong>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <p>Penjual</p>
                        <strong></strong>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12 table-responsive">
                    <table width="100%"
                            class="tb-barang table table-hover table-bordered text-nowrap dataTable dtr-inline table-sm"
                            aria-describedby="example2_info">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center" scope="col">No</th>
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
                                    <td>{{$k->kode_barang}}</td>
                                    <td>{{$k->kode_barang}}</td>
                                    <td>{{$k->nama_barang}}</td>
                                    <td>{{$k->harga_barang}}</td>
                                    <td class="text-right">{{abs($k->qty)}}</td>
                                    <td class="text-right">{{number_format($k->harga_barang * abs($k->qty),2)}}</td>
                                </tr>
                                @php
                                $total_qty += abs($k->qty);
                                $total_harga += $k->harga;
                                @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-center" colspan="5">Total</td>
                                    <td class="text-right"><?= $total_qty ?></td>
                                    <td class="text-right"><?= number_format($total_harga,2) ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection
@section('js')
@endsection
