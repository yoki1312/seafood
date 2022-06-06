@extends('admin.template_index')
@section('template_index')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Setting profile</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">

            <!-- /.col -->
            <div class="col-md-9">
                <form method="post" action="{{ route('user.update') }}" enctype="multipart/form-data">
                    @csrf
                    <input name="id_user" type="text" value="{{ $data->id }}" class="form-control" hidden
                        id="inputPassword4" placeholder="Nama Toko">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="inputPassword4">Foto Profile</label>
                                                    <input name="file" type="file" class="file-foto" />
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4">Nama</label>
                                                    <input name="name" type="text" value="{{ $data->name }}"
                                                        class="form-control" id="inputPassword4"
                                                        placeholder="Nama Toko">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Email</label>
                                                    <input name="email" type="email"
                                                        value="{{ $data->email }}" class="form-control"
                                                        id="inputEmail4" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Nomor Telp</label>
                                                    <input name="nomor_wa" type="number"
                                                        value="{{ $data->nomor_wa }}" class="form-control"
                                                        id="inputEmail4" placeholder="Email">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4">Password</label>
                                                    <input name="password" type="password" class="form-control"
                                                    id="inputPassword4" placeholder="Password">
                                                </div>
                                                <div class="col-sm-12">
                                                    <label for="">Alamat</label>
                                                    <textarea name="alamat" class="form-control">{{ $data->alamat }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <a href="{{ url('user') }}" class="btn btn-sm btn-danger">Kembali</a>
                                    <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

@endsection
@section('js')

<script>
    $(document).ready(function () {
        var file = "{{ url('foto-user/') }}" + "/" +"{{ $data->foto_profile }}"
        console.log(file);
        $(".file-foto").fileinput({
            'showUpload': false,
            'previewFileType': 'any',
            initialPreviewAsData: true,
            initialPreview: file,
            preferIconicZoomPreview : false
        });
    })

</script>
@endsection
