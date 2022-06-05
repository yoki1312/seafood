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
                <form method="post" action="{{ route('akunSupplier.update') }}" enctype="multipart/form-data" >
                    @csrf
                    <input name="general[id]" type="text" value="{{ $profile->id }}" class="form-control" hidden id="inputPassword4" placeholder="Nama Toko">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity"
                                    data-toggle="tab">General</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Toko</a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputPassword4">Foto Profile</label>
                                                <input name="foto_profile" type="file" class="foto-toko" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Nama</label>
                                                <input name="general[nama]" type="text"
                                                    value="{{ $profile->name }}"
                                                    class="form-control" id="inputPassword4" placeholder="Nama Toko">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Username</label>
                                                <input name="general[username]" type="text"
                                                    value="{{ $profile->username }}"
                                                    class="form-control" id="inputEmail4" placeholder="Username">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Email</label>
                                                <input name="general[email]" type="email"
                                                    value="{{ $profile->email }}"
                                                    class="form-control" id="inputEmail4" placeholder="Email">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Password</label>
                                                <input name="general[password]" type="password" class="form-control"
                                                    id="inputPassword4" placeholder="Password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="settings">
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Nama Bank</label>
                                    <div class="col-sm-10">
                                        <input name="data_supplier[nama_bank]" value="{{ $data->nama_bank }}" type="text" class="form-control"
                                            id="inputEmail" placeholder="Nama Bank">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">No Rekening</label>
                                    <div class="col-sm-10">
                                        <input name="data_supplier[no_rek]" value="{{ $data->no_rek }}" type="text" class="form-control"
                                            id="inputName" placeholder="Nomor Rekening">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName2" class="col-sm-2 col-form-label">Nomor Whatsaap</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="data_supplier[nomor_wa]" value="{{ $data->no_wa }}" class="form-control"
                                            id="inputName2" placeholder="Nomor Whatsaap">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputExperience" class="col-sm-2 col-form-label">Kota</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="data_supplier[kota]" value="{{ $data->kota }}" class="form-control"
                                            id="inputName2" placeholder="Kota">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputSkills" class="col-sm-2 col-form-label">Alamat lengkap</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="data_supplier[alamat_lengkap]"
                                            cols="3">{{ $data->alamat_lengkap }}</textarea>
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
                            <a href="{{ url('akunSupplier') }}" class="btn btn-sm btn-danger">Kembali</a>
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
        $(".foto-toko").fileinput({
            'showUpload': false,
            'previewFileType': 'any'
        });
    })

</script>
@endsection
