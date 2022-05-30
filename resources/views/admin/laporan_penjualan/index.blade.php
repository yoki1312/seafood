@extends('admin.template_index')
@section('template_index')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Laporan Transaksi</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Laporan Penjualan per Barang</li>
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
                    <div class="col-sm-12 form-group">
                        <table width="100%"
                            class="tb-barang table table-hover text-nowrap dataTable dtr-inline table-sm"
                            aria-describedby="example2_info">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Kode Transaksi</th>
                                    <th class="text-center">Tanggal Transaksi</th>
                                    <th class="text-center">Nama Pembeli</th>
                                    <th class="text-center">Status Transaksi</th>
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
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@section('js')
<script>
    $(document).ready(function () {
        var table = $('.tb-barang').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('lappenjualan.index') }}",
            columns: [{
                    data: 'id_transaksi',
                    className: 'text-center',
                    searchable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'kode_transaksi',
                },
                {
                    data: 'tanggal_transaksi',
                    searchable: false,
                    className: 'text-center',
                    render: function (meta, data, row, type) {
                        return moment(row.tanggal_transaksi).format('DD-MM-YYYY')
                    }
                },
                {
                    data: 'nama_pembeli',
                    className: 'text-center',
                },
                {
                    data: 'nama_status',
                    className: 'text-center',
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
