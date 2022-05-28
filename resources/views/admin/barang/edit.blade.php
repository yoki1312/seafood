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
        <form action="{{  route('barang.update',['id_barang', $data->id_barang]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Kode Barang</label>
                            <input type="text" name="kode_barang" value="{{ $data->kode_barang }}" class="form-control">
                            <input type="hidden" name="id_barang" value="{{ $data->id_barang }}" class="form-control">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Nama Barang</label>
                            <input type="text" name="nama_barang" value="{{ $data->nama_barang }}" class="form-control">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Harga Barang</label>
                            <input type="text" name="harga_barang" value="{{ $data->harga_barang }}" class="form-control text-right">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Satuan Barang</label>
                            <select name="satuan_barang" class="form-control">
                                <option>KG</option>
                                <option>Ton</option>
                            </select>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Deskripsi Barang</label>
                            <textarea name="deskripsi_barang" class="form-control">{{ $data->deskripsi_barang }}</textarea>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Foto Barang</label>
                            <input type="file" name="file[]" class="file-barang" multiple />
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="{{ route('barang.index') }}" class="btn btn-sm btn-danger">Kembali</a>
                            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- /.content -->
@endsection
@section('js')

<script>
    $(document).ready(function () {
            var dataGambar = [];
           <?php foreach($detail as $k) : ?>
                dataGambar.push(
                    "{{ url('').'/produk/'.$k->file }}"
                )
           <?php endforeach; ?>
        $(".file-barang").fileinput({
            showCaption: false,
            showRemove: false,
            showUpload: false,
            initialPreviewAsData: true,
            initialPreview: dataGambar
        });
    })

</script>
@endsection
