@extends('front.index')
@section('front')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="https://asset-a.grid.id/crop/0x0:0x0/750x500/photo/makemac/2014/06/Wallpaper-iOS-8.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Edit Profile</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Edit Profile</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
<section class="product-details spad" style="padding-top:35px !important">
    <div class="container">
        <div class="checkout__form">
            <h4>Profile</h4>
            <form action="{{ route('user.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input class="form-control form-control-sm" type="hidden" name="id_user" value="{{ Auth::user()->id }}" type="text">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Nama Lengkap<span>*</span></p>
                                    <input class="form-control form-control-sm" type="text" name="name" value="{{ Auth::user()->name }}" type="text">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Alamat Email<span>*</span></p>
                                    <input class="form-control form-control-sm" type="email" name="email" value="{{ Auth::user()->email }}" type="text">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Nomor Telp</p>
                                    <input class="form-control form-control-sm" type="number" name="nomor_wa" value="{{ Auth::user()->nomor_wa }}" type="text">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Password Baru</p>
                                    <input class="form-control form-control-sm" type="password" name="password" type="text">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="checkout__input">
                                    <p>Alamat <span>*</span></p>
                                    <textarea cols="6" name="alamat" class="form-control">{{ Auth::user()->alamat }}</textarea>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-lg-4 col-md-6">
                            <input type="file" name="file" class="file-foto" />
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <hr>
                        <button class="btn btn-success">Perbarui Profile</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<hr>
<!-- Product Details Section End -->
@endsection
@section('js')
<script>
    $(document).ready(function () {
        var file = "{{ url('foto-user/') }}" + "/" +"{{ Auth::user()->foto_profile }}"
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
