@extends('admin.template_index')
@section('template_index')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Master Transaksi</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Jenis Transaksi</li>
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
                    <div class="card-header">
                        <div class="row">

                            <div class="col-sm-12 text-left">
                                <a href="{{ route('transaksi.create') }}" class="btn btn-sm btn-success">Tambah baru</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <table width="100%"
                                    class="tb-barang table table-hover text-nowrap dataTable dtr-inline table-sm"
                                    aria-describedby="example2_info">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">jenis transaksi</th>
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
            ajax: "{{ route('transaksi.index') }}",
            columns: [{
                    data: 'id_jenis_barang',
                    className: 'text-center',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'jenis_transaksi',
                    name: 'name'
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
