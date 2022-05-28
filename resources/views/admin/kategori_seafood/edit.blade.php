@extends('admin.template_index')
@section('template_index')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Master Kategori</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Master Kategori</li>
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
            <div class="col-sm-6">
                <form action="{{  route('kategori.update',['id_kategori_seafood', $data->id_kategori_seafood]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <label>Nama Kategori</label>
                                    <input type="text" name="nama_kategori" value="{{ $data->nama_kategori }}" class="form-control">
                                    <input type="hidden" name="id_kategori_seafood" value="{{ $data->id_kategori_seafood }}" class="form-control">
                                </div>
                    
                                <div class="col-sm-12 form-group">
                                    <label>Foto Barang</label>
                                    <input type="file" name="file" class="file-barang" multiple />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <a href="{{ route('kategori.index') }}" class="btn btn-sm btn-danger">Kembali</a>
                                    <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection
@section('js')

<script>
    $(document).ready(function () {
        var dataGambar =  "{{ url('').'/kategori-image/'.$data->gambar_kategori }}" ;
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
