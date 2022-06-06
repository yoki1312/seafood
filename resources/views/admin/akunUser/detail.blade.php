@extends('admin.template_index')
@section('template_index')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Detail User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Detail User</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- /.col -->
            <div class="col-md-3">

                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" style="width:210px" src="{{ asset('foto-user/'. $data->foto_profile) }}" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $data->name }}</h3>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Tanggal Daftar</b> <a class="float-right">{{ date('d-m-Y', strtotime($data->created_at)) }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                    <div class="card">
                        
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="inputPassword4">Nama</label><br>
                                                    <h>{{ $data->name }}</h>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail4">E-mail</label><br>
                                                    <h>{{ $data->email }}</h>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail4">Nomor Telp</label><br>
                                                    <h>{{ $data->nomor_wa }}</h>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail4">Alamat</label><br>
                                                    <h>{{ $data->alamat }}</h>
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
