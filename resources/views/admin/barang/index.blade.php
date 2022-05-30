@extends('admin.template_index')
@section('template_index')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Master Barang</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Master Barang</li>
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
            <div class="card-header">
                <div class="row">

                    <div class="col-sm-12 text-left">
                        <a href="{{ route('barang.create') }}" class="btn btn-sm btn-success">Tambah baru</a>
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
                                    <th class="text-center">Gambar Barang</th>
                                    <th class="text-center">Kode Barang</th>
                                    <th class="text-center">Nama Barang</th>
                                    <th class="text-center">Harga Barang</th>
                                    <th class="text-center">Stock Barang</th>
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
<div class="modal fade" id="modal-tambah-stok" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Stock Saat Ini Barang </label>
                        <input type="number" name="" class="form-control form-control-sm text-right stock-now" readonly id="">
                    </div>
                    <div class="col-sm-3">
                        <label>Kategori Transaksi </label>
                        <select class="form-control form-control-sm kategori-transaksi" onchange="calculateStock()">
                            <option value="1">Tambah Stok</option>
                            <option value="2">Penggurangan Stok</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label>Jumlah Stock</label>
                        <input type="number" oninput="calculateStock()" name="" class="form-control form-control-sm text-right qty-baru" id="">
                    </div>
                    <div class="col-sm-3">
                        <label>Total Stock</label>
                        <input type="number"  name="" class="form-control form-control-sm text-right totalStock" id="">
                    </div>
                    <!-- <div class="col-sm-2">
                        <label>Satuan </label>
                        <input type="text"  name="" class="form-control form-control-sm text-right satuan-stock" readonly id="">
                    </div> -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-save-stok">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
@endsection
@section('js')
<script>
    $(document).ready(function () {
        var url = "{{ asset('produk/') }}"
        var table = $('.tb-barang').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('barang.index') }}",
            columns: [{
                    data: 'id_barang',
                    className: 'text-center',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'file_sampul',
                    className: 'text-center',
                    render: function (meta, data, row, type) {
                        return '<img style="max-width: 100px;" src="'+ url +'/'+ row.file_sampul + '" />';
                    }
                },
                {
                    data: 'kode_barang',
                    name: 'name'
                },
                {
                    data: 'nama_barang',
                    name: 'email'
                },
                {
                    data: 'harga_barang',
                    className: 'text-right',
                    render: $.fn.dataTable.render.number(',', '.', 3, 'Rp'),
                },
                {
                    data: 'qty',
                    name: 'email',
                    className: 'text-right',
                    render: function (meta, data, row, type) {
                        return row.qty == null ? 0 : row.qty
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
        $(document).on('click', '.btn-modal-stok', function () {
            var data = table.row($(this).parents('tr')).data();
            listenDataRow = data
            let modal = $('#modal-tambah-stok');
            modal.find('.nama-barang').text(data.nama_barang)
            modal.find('.satuan-stock').val(data.satuan_barang)
            modal.find('.stock-now').val(data.qty || 0)
            modal.modal('show');

        });
        $(document).on('click','.btn-save-stok', function () {
            let modal = $('#modal-tambah-stok');
            var qty = modal.find('.qty-baru').val();
            var url = '{{ route("barang.tambahStock") }}';
            if($('.kategori-transaksi').val() == 2){
                qty = qty *-1
            }
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    id_barang: listenDataRow.id_barang,
                    qty: qty
                },
                success: function (response) {
                   table.ajax.reload(null,false);
                   modal.modal('hide')
                },
                error: function (error) {
                    console.log(error)
                }
            });
        })
    })
    function calculateStock(){
        var stockReady = parseInt($('.stock-now').val());
        var stokBaru = $('.qty-baru').val();
        if($('.kategori-transaksi').val() == 1){
            var totalStock = parseInt(stockReady) + parseInt(stokBaru);
        }
        if($('.kategori-transaksi').val() == 2){
            var totalStock = parseInt(stockReady) - parseInt(stokBaru);
        }
        $('.totalStock').val(totalStock)   
    }
</script>
@endsection
