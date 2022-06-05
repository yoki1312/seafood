<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assetAdmin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assetAdmin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assetAdmin/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assetAdmin/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assetAdmin/css/fileinput.min.css') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box" style="width: 50%;">
        <div class="login-logo">
            <a href="../../index2.html"><b>Seafood</b>Pangkah</a>
        </div>
        <!-- /.login-logo -->
        <form action="{{ url('register/akun/supplier') }}" method="post" enctype="multipart/form-data">
            @csrf
        <div class="card">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card-body login-card-body">

                        <div class="input-group mb-3">
                            <label class="form-label" >Foto Identitas</label><br>
                            <input name="file" class="file" type="file" placeholder="Email">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card-body login-card-body">
                        <p class="login-box-msg">Registrasi Supplier</p>

                       
                            <div class="input-group mb-3">
                                <input name="nama_supplier" type="text" class="form-control"
                                    placeholder="Nama Supplier">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input name="username" type="text" class="form-control" placeholder="Username">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input name="email" type="email" class="form-control" placeholder="Email">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input name="password" type="password" class="form-control" placeholder="Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea style="height:116px" name="alamat" class="form-control" cols="12" required>Alamat</textarea>
                            </div>

                        <!-- /.social-auth-links -->

                       
                    </div>
                </div>

            </div>
            <div class="row text-center">
                <!-- /.col -->
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                    <p class="mb-1">
                            <a href="{{ url('login/supplier') }}">Already Account !</a>
                        </p>
                </div>
                <div class="col-sm-4">
                </div>
                <!-- /.col -->
            </div>
            <!-- /.login-card-body -->
        </div>
        </form>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('assetAdmin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assetAdmin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assetAdmin/js/adminlte.js') }}"></script>
    <script src="{{ asset('assetAdmin/js/toastr.min.js') }}"></script>
    <script src="{{ asset('assetAdmin/js/fileinput.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(".file").fileinput({
                'showUpload': false,
                'previewFileType': 'any'
            });
        })

    </script>
    @toastr_render
</body>

</html>
