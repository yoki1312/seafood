@extends('front.index')
@section('front')
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('assetFront/img/breadcrumb.webp')  }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Detail Pesanan</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Detail Pesanan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="shoping-cart spad" style="padding-top:40px !important">
    <form action="{{ route('pesanan.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="#">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6 form-group">
                                    <p>Fist Name<span class="text-danger">*</span></p>
                                    <input class="form-control form-control-sm" type="text">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <p>Last Name<span class="text-danger">*</span></p>
                                    <input class="form-control form-control-sm" type="text">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <p>Nomor Hp<span class="text-danger">*</span></p>
                                    <input class="form-control form-control-sm" type="text">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <p>Kota<span class="text-danger">*</span></p>
                                    <input class="form-control form-control-sm" type="text">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <p>Alamat Lengkap<span>*</span></p>
                                    <textarea style="width:100%" class="form-control" id="" cols="30"></textarea>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <p>Catatan Pembelian</p>
                                    <textarea style="width:100%" class="form-control" id="" cols="30"></textarea>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Produk</th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total=0; ?>
                                        @foreach($data as $d)
                                        <tr>
                                            <td>{{ $d->nama_barang }}</td>
                                            <td class="text-right">{{ abs(number_format($d->qty,0)) }}</td>
                                            <td class="text-right">{{ number_format($d->harga,0) }}</td>
                                        </tr>
                                        <?php $total += $d->harga; ?>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="checkout__order__total">Total <span>Rp {{ number_format($total,0) }}</span>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <p>Bukti Pembayaran</p>
                                    <input type="file" id="payment">
                                </div>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </form>
</section>

@endsection
@section('js')
<script>
    $(document).ready(function () {
        var url = "{{ asset('produk/') }}"
        var table = $('.tb-barang').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            lengthChange: false,
            "ordering": false,
            ajax: "{{ route('riwayatPesanan.index') }}",
            columns: [{
                    data: 'kode_transaksi',
                    className: 'text-center',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'kode_transaksi',
                    className: 'text-left',
                },
                {
                    data: 'tanggal_transaksi',
                    className: 'text-center',
                },
                {
                    data: 'total_barang',
                    className: 'text-right',
                    render: function (meta, data, row) {
                        return renderRp(Math.abs(row.total_barang), 0);
                    }
                },
                {
                    data: 'nama_status',
                    className: 'text-center',
                    render: function (meta, data, row) {
                        return '<span class="badge badge-info">' + row.nama_status + '</span>';
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    className: 'text-center',
                    orderable: false,
                    searchable: false
                },
            ]
        });



    })

</script>
@endsection
