@extends('admin.template_index')
@section('template_index')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Laporan Pembeli</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Laporan Pembeli</li>
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
                                    <th class="text-center">Nama Pembeli</th>
                                    <th class="text-center">Total Qty</th>
                                    <th class="text-center">Total Harga</th>
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
<div class="modal fade bd-example-modal-lg btn-modal-history" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-sm dt-history">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center" scope="col">No</th>
                                    <th class="text-center" scope="col">Kode Transaksi</th>
                                    <th class="text-center" scope="col">Tanggal Transaksi</th>
                                    <th class="text-center" scope="col">Qty</th>
                                    <th class="text-center" scope="col">Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center" colspan="3">Total</th>
                                    <th class="text-right"><span class="total-qty"></span></th>
                                    <th class="text-right"><span class="total-harga"></span></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function () {
        var url = "{{ asset('produk/') }}"
        var table = $('.tb-barang').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('daftarPembeli.index') }}",
            columns: [{
                    data: 'id_barang',
                    className: 'text-center',
                    searchable: false,
                    orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'nama_pembeli',
                },
                {
                    data: 'qty',
                    name: 'email',
                     searchable: false,
                    className: 'text-right',
                    render: function (meta, data, row, type) {
                        return renderRp(row.total_qty, 0)
                    }
                },
                {
                    data: 'qty',
                    name: 'email',
                     searchable: false,
                    className: 'text-right',
                    render: function (meta, data, row, type) {
                        return renderRp(row.total_harga, 0)
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

        var listenDataRow;
        $(document).on('click', '.btn-open-modal-history', function () {
            var data = table.row($(this).parents('tr')).data();
            let modal = $('.btn-modal-history');
            let tableHistory = modal.find('.dt-history');
            modal.modal('show');
            
            var detail = data.history;
            var td = '';
            var i = 1;
            let total_harga = 0;
            let total_qty = 0;
            detail.forEach((pro)=>{
                td += '<tr>'
                td += '<td class="text-center">' + i + '</td>'
                td += '<td>' + pro.kode_transaksi + '</td>'
                td += '<td>' + pro.tanggal_transaksi + '</td>'
                td += '<td class="text-right">' + renderRp(Math.abs(pro.total_qty),0) + '</td>'
                td += '<td class="text-right">' + renderRp(pro.total_harga,0) + '</td>'
                td += '</tr>'
                total_harga += parseFloat(pro.total_harga);
                total_qty += Math.abs(pro.total_qty);
                i++;
            });
            tableHistory.find('tbody').empty().append(td);
            tableHistory.find('.total-harga').text(renderRp(total_harga,0))
            tableHistory.find('.total-qty').text(renderRp(total_qty,0))

        });
    })


</script>
@endsection
