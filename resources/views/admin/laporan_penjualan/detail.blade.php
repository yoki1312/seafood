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
                        <h4>
                            <img src="{{ asset('assetFront/img/logo.png') }}" style="max-width: 160px;" alt="">
                            <small class="float-right">Date: {{ date('d-M-Y', strtotime($header->created_at)) }}</small>
                        </h4>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        Toko
                        <address>
                            <strong>Admin</strong><br>
                            {{ getContackUs()->alamat_center }}<br>
                            No Telp: {{ getContackUs()->telp_center }}<br>
                            Email: {{ getContackUs()->email_center }}
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        To
                        <address>
                            <strong>{{ $data_transaksi->nama }}</strong><br>
                            {{ $data_transaksi->alamat_lengkap }}<br>
                            No Telp: {{ $data_transaksi->nomor_hp }}<br>
                            Email: {{ $data_transaksi->email }}
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>Kode Transaksi {{ $header->kode_transaksi }}</b><br>
                        <br>
                        <b>Status Transaksi:</b> {{ $header->nama_status }}<br>
                        <b>Catatan Pembeli:</b> {{ $data_transaksi->catatan }}<br>
                        <b>File Pembayaran:</b> <a target="_blank"
                            href={{ asset('file-pembayaran/'.$data_transaksi->file)}}>Lihat File Pembayaran</a>
                    </div>
                    <!-- /.col -->
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
                           
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-6">

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr class="text-right">
                                        <th style="width:50%">Total:</th>
                                        <td>{{ number_format($total_harga,0) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row no-print">
                    <div class="col-12">
                        <a href="{{ route('lappenjualan.index') }}" rel="noopener" class="btn btn-danger"> Back</a>
                        @if($header->id_status != 2 && Auth::guard('admin')->user()->is_super == 1 )
                        <a href="{{ url('laporan_penjualan/acc_pembayaran/'.$data_transaksi->id_transaksi) }}" class="btn btn-success float-right"><i class="far fa-credit-card"></i>
                            Approve pembayaran
                        </a>
                        @endif
                        <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                            <i class="fas fa-download"></i> Generate PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection
@section('js')
<script>
    $(document).ready(function () {
        $('.close-sidebar').click()
    })

</script>
@endsection
