@extends('admin.template_index')
@section('template_index')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Penjual</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Data Penjual</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
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
                                            <th class="text-center">Nama Toko</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Tanggal Terdaftar</th>
                                            <th class="text-center">Total Barang</th>
                                            <th class="text-center">Total Penjualan</th>
                                            <th class="text-center">Status Akun</th>
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

            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@section('js')
<script>
    $(document).ready(function () {
        var params = null;
        var table = $('.tb-barang').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('akunSupplier.index') }}",
            columns: [{
                    data: 'id',
                    className: 'text-center',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'name'
                },
                {
                    data: 'created_at',
                    className : 'text-center',
                    render: function (data, type, row, meta) {
                        return moment(data).format('DD-MM-YYYY hh:mm:ss');
                    }
                },
                {
                    data: 'total_barang',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row, meta) {
                        return (row.total_barang || 0) + ' Barang';
                    }
                },
                {
                    data: 'total_penjualan',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row, meta) {
                        return (row.total_penjualan || 0) + ' Transaksi';
                    }
                },
                {
                    data: 'total_penjualan',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row, meta) {
                        return row.status_aktif == 1 ? '<span class="badge badge-primary">Aktif</span>' : '<span class="badge badge-warning">Belum Aktif</span>';
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
