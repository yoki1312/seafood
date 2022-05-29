@extends('front.index')
@section('front')
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('assetFront/img/breadcrumb.webp')  }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Daftar Pesanan</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Daftar Pesanan</span>
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-sm tb-barang">
                            <thead class="table-primary">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Kode Transaksi</th>
                                    <th class="text-center">Tanggal Transaksi</th>
                                    <th class="text-center">Jumlah Barang</th>
                                    <th class="text-center">Status Pesanan</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>

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
                        var elm = '';
                        if (row.id_status == 1) {
                            elm += '<span class="badge badge-info">' + row.nama_status +
                                '</span>';
                        }else{

                            elm += '<span class="badge badge-success">' + row.nama_status +
                                '</span>';
                        }
                        return elm
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

        $(document).on('click', '.btn-hapus-pesanan', function () {
            let id_transaksi = $(this).attr('data-id')
            Swal.fire({
                title: 'Batalkan pesanan?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Batalkan !'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("{{ url('/pesanan/destroyTransaksi/') }}" + '/' + id_transaksi, function (data) {
                        if (data.success == true) {
                            Swal.fire(
                                'Berhasil!',
                                'Pesanan berhasil dihapus.',
                                'success'
                            );
                            table.ajax.reload(null, true)
                        }
                    });
                }
            })
        })



    })

</script>
@endsection
