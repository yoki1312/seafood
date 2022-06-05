@extends('front.index')
@section('front')

<!-- <section class="breadcrumb-section set-bg" data-setbg="https://asset-a.grid.id/crop/0x0:0x0/750x500/photo/makemac/2014/06/Wallpaper-iOS-8.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Contact Us</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Contact Us</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<section class="contact spad" style="padding-top:0px !important">
    <div class="container">
        <div class="row text-center">
            <div class="col-sm-12">
                <img style="max-width:50%;" src="{{ asset('foto-contact-us/'. getContackUs()->gambar) }}"
                    alt="User profile picture">
            </div>
        </div>
        <div class="row text-center">
            <div class="col-sm-12">
                <h3><b>{{ getContackUs()->judul }}</b></h3>
            </div>
        </div>
        <hr>
        <div class="row text-center">
            <div class="col-sm-12">
            
               <p>{{ getContackUs()->keterangan }}</p>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-sm-4 text-center">
                <div class="contact__widget">
                    <span class="icon_phone"></span>
                    <h4>Phone</h4>
                    <p>{{ getContackUs()->telp_center }}</p>
                </div>
            </div>
            <div class="col-sm-4 text-center">
                <div class="contact__widget">
                    <span class="icon_pin_alt"></span>
                    <h4>Address</h4>
                    <p>{{ getContackUs()->alamat_center }}</p>
                </div>
            </div>
            <div class="col-sm-4 text-center">
                <div class="contact__widget">
                    <span class="icon_mail_alt"></span>
                    <h4>Email</h4>
                    <p>{{ getContackUs()->email_center }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
