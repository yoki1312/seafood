@extends('admin.template_index')
@section('template_index')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Detail Penjual</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Detail Penjual</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" style="width:210px" src="{{ asset('foto-supplier/'. $profile->foto_profile) }}" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $profile->name }}</h3>

                        <p class="text-muted text-center">{{ $profile->username }}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Tanggal Daftar</b> <a class="float-right">{{ date('d-m-Y', strtotime($profile->created_at)) }}</a>
                            </li>
                            @if($profile->status_aktif != 0)
                       
                                <li class="list-group-item">
                                    <b>Tanggal Aktif</b> <a class="float-right">{{ date('d-m-Y', strtotime($profile->tanggal_aktif)) }}</a>
                                </li>
                           
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity"
                                        data-toggle="tab">General</a></li>
                                <li class="nav-item"><a class="nav-link " href="#settings" data-toggle="tab">Toko</a>
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
                                                    <label for="inputPassword4">Nama</label><br>
                                                    <h>{{ $profile->name }}</h>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail4">User name</label><br>
                                                    <h>{{ $profile->username }}</h>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail4">E-mail</label><br>
                                                    <h>{{ $profile->email }}</h>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane " id="settings">
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Nama Bank</label>
                                        <div class="col-sm-10">
                                            <input disabled name="data_supplier[nama_bank]"
                                                value="{{ $data->nama_bank }}" type="text"
                                                class="form-control" id="inputEmail" placeholder="Nama Bank">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">No Rekening</label>
                                        <div class="col-sm-10">
                                            <input disabled name="data_supplier[no_rek]" value="{{ $data->no_rek }}"
                                                type="text" class="form-control" id="inputName"
                                                placeholder="Nomor Rekening">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">Nomor Whatsaap</label>
                                        <div class="col-sm-10">
                                            <input disabled type="text" name="data_supplier[nomor_wa]"
                                                value="{{ $data->no_wa }}" class="form-control"
                                                id="inputName2" placeholder="Nomor Whatsaap">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-sm-2 col-form-label">Kota</label>
                                        <div class="col-sm-10">
                                            <input disabled type="text" name="data_supplier[kota]"
                                                value="{{ $data->kota }}" class="form-control"
                                                id="inputName2" placeholder="Kota">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputSkills" class="col-sm-2 col-form-label">Alamat lengkap</label>
                                        <div class="col-sm-10">
                                            <textarea disabled class="form-control" name="data_supplier[alamat_lengkap]"
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
                                    @if($profile->status_aktif == 0)
                                    <a href="{{ route('akunSupplier.aktif',['id_supplier' => $profile->id]) }}"  class="btn btn-sm btn-success">Aktifkan Akun</a>
                                    @else
                                    <a href="{{ route('akunSupplier.nonaktif',['id_supplier' => $profile->id]) }}" class="btn btn-sm btn-warning">Non Aktifkan Akun</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
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
