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
        <form action="{{  route('barang.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Kode Barang</label>
                            <input type="text" name="kode_barang" value="{{ $kodeBarang }}" class="form-control form-control-sm ">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control form-control-sm ">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Harga Barang</label>
                            <input type="text" name="harga_barang" class="form-control form-control-sm  text-right">
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>Satuan Barang</label>
                            <select name="satuan_barang" class="form-control form-control-sm ">
                                <option value="kg">KG</option>
                                <option value="pcs">PCS</option>
                            </select>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>Kategori Barang</label>
                            <select name="id_kategori" class="form-control form-control-sm ">
                               @foreach($kategori as $r)
                                    <option value="{{ $r->id_kategori_seafood }}">{{ $r->nama_kategori }}</option>
                               @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Deskripsi Barang</label>
                            <textarea name="deskripsi_barang" class="form-control form-control-sm "></textarea>
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
        $(".file-barang").fileinput({
            'showUpload': false,
            'previewFileType': 'any'
        });
    })

</script>
@endsection
