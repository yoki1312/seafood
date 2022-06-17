<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Serba Serbi Ujungpangkah</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('assetFront/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assetFront/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assetFront/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assetFront/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assetFront/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assetFront/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assetFront/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assetFront/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assetFront/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('summernote/summernote-bs4.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assetAdmin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assetAdmin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assetAdmin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assetAdmin/css/fileinput.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assetAdmin/css/toastr.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @if(isset(Auth::user()->id))
    <meta name="id_user" content="{{ Auth::user()->id }}" />
    @endif
</head>
<style>
    .checked-rating {
        color: orange;
    }

</style>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="{{ asset('assetFront/img/logo.png') }}" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="{{ url('pesanan') }}"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                @if(isset(Auth::user()->id ))
                <i class="fa fa-user"></i>
                <div>{{ Auth::user()->name }}</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="{{ url('detail/user') }}">Edit Profil</a></li>
                    <li> <a class="dropdown-item" href="{{ url('logout/user') }}">
                            {{ __('Logout') }}
                        </a></li>
                </ul>

                @else
                <a type="button" data-toggle="modal" data-target="#modal-login"> Login </a>
                <!-- <a href="{{ url('login/pembeli') }}"><i class="fa fa-user"></i> Login</a> -->

                @endif
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="home-li"><a href="{{ url('/') }}">Dashboard</a></li>
                <li class="shop-li"><a href="{{ route('shop.index')}}">Produk</a></li>
                @if(isset(Auth::user()->id ))
                <li class="pembelian-li"><a href="#">Pembelian</a>
                    <ul class="header__menu__dropdown">
                        <li class="pembelian-li"><a href="{{ route('pesanan.index')}}">Keranjang Saya</a></li>
                        <li class="pembelian-li"><a href="{{ route('riwayatPesanan.index') }}">Riwayat Pembelian</a>
                        </li>
                    </ul>
                </li>
                @endif
                <li class="contact-li"><a href="{{ url('contact-us') }}">Tentang Kami</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                <li>Free Shipping for all Order of $99</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> {{ getContackUs()->email_center }}</li>
                                <!-- <li>Free Shipping for all Order of $99</li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i> Seafood Ujungpangkah</a>
                                <!-- <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a> -->
                            </div>
                            <div class="header__top__right__language">
                                @if(isset(Auth::user()->id ))
                                <i class="fa fa-user"></i>
                                <div>{{ Auth::user()->name }}</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="{{ url('detail/user') }}">Edit Profil</a></li>
                                    <li> <a class="dropdown-item" href="{{ url('logout/user') }}">
                                            {{ __('Logout') }}
                                        </a></li>
                                </ul>
                                @else
                                <!-- <a href="{{ url('login/pembeli') }}"><i class="fa fa-user"></i> Login</a> -->
                                <a type="button" data-toggle="modal" data-target="#modal-login"><small><i
                                            class="fa fa-user"></i> Login</small> </a>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.html"><img src="{{ asset('assetFront/img/logo.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu text-center">
                        <ul>
                            <li class="home-li"><a href="{{ url('/') }}">Home</a></li>
                            <li class="shop-li"><a href="{{ route('shop.index')}}">Produk</a></li>
                            @if(isset(Auth::user()->id ))
                            <li class="pembelian-li"><a href="#">Pembelian</a>
                                <ul class="header__menu__dropdown text-left">
                                    <li class="pembelian-li"><a href="{{ route('pesanan.index')}}">Keranjang Saya</a>
                                    </li>
                                    <li class="pembelian-li"><a href="{{ route('riwayatPesanan.index') }}">Riwayat
                                            Pembelian</a></li>
                                </ul>
                            </li>
                            @endif
                            <li class="contact-li"><a href="{{ url('contact-us') }}">Tentang Kami</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <!-- <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li> -->
                            <li><a href="{{ url('pesanan') }}"><i class="fa fa-shopping-bag"></i>
                                    <?= isset(Auth::user()->id) ? '<span class="dt-krs">'. getKeranjang().'</span>' : '' ?>
                                </a></li>
                        </ul>
                        <!-- <div class="header__cart__price">item: <span>$150.00</span></div> -->
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Kategori Seafood</span>
                        </div>
                        <ul
                            style="display: none;position: absolute; left: 0; top: 46px; width: 100%; z-index: 9; background: #ffffff;">
                            @foreach(sliderKategori() as $l)
                            <li><a type="button" onclick="setGlobalKategoriFilter(this)"
                                    data-id="{{ $l->id_kategori_seafood }}">{{ $l->nama_kategori }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">

                                <input type="text" class="filter-nama-global" placeholder="Tampilkan Semua Barang">
                                <button type="button" onclick="setGlobalNamaFilter()" class="site-btn">Cari
                                    Barang</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>Layanan 08:00 - 16:00</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
    @section('front')
    @show
    <div class="modal fade" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12" style="padding-left: 32px;padding-right: 32px;padding-top: 25px;">
                        <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group text-center">
                                    <img style="max-width: 70%;" src="{{ asset('assetFront/img/logo.png') }}" alt="">
                                <hr>
                                </div>
                                <div class="form-group">
                                    <label for="">Email address</label>
                                    <input type="email" class="form-control" name="email" 
                                        aria-describedby="emailHelp" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" class="form-control" 
                                        placeholder="Password">
                                </div>
                                <div class="form-group text-right">
                                    <p class="text-center">Belum punya akun ?  <a class="modal-register" type="button"> <i class="fa fa-user"></i> Register</a></p>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Login</button>
                                  
                                </div>
                                </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12" style="padding-left: 32px;padding-right: 32px;padding-top: 25px;">
                        <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group text-center">
                                    <img style="max-width: 70%;" src="{{ asset('assetFront/img/logo.png') }}" alt="">
                                <hr>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="name" 
                                        aria-describedby="emailHelp" placeholder="Nama Lengkap">
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat Email</label>
                                    <input type="email" class="form-control" name="email" 
                                        aria-describedby="emailHelp" placeholder="Alamat email">
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" class="form-control" 
                                        placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="">Confirm Password</label>
                                    <input placeholder="Confirm Password" type="password" id="password-confirm" class="form-control" name="password_confirmation" required autocomplete="new-password" />
                                </div>
                                <div class="form-group text-right">
                                    <p class="text-center">Daftar sebagai penjual ?  <a href="{{ url('register/supplier') }}"> <i class="fa fa-user"></i> Register</a></p>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Daftar</button>
                                  
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="{{ asset('assetFront/img/logo.png') }}" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 New York</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: hello@colorlib.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text">
                            <p>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>
                                    document.write(new Date().getFullYear());

                                </script> All rights reserved | This template is made with <i class="fa fa-heart"
                                    aria-hidden="true"></i> by <a href="https://colorlib.com"
                                    target="_blank">Colorlib</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                        <div class="footer__copyright__payment"><img
                                src="{{ asset('assetFront/img/payment-item.png') }}" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{ asset('assetFront/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assetFront/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assetFront/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assetFront/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assetFront/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('assetFront/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('assetFront/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assetFront/js/main.js') }}"></script>
    <script src="{{ asset('sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('accounting.min.js') }}"></script>
    <script src="{{ asset('summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('assetAdmin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assetAdmin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assetAdmin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assetAdmin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assetAdmin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assetAdmin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assetAdmin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assetAdmin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assetAdmin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assetAdmin/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('assetAdmin/js/toastr.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('click', '.header__menu ul li', function () {
                localStorage.setItem("linkActive", $(this).attr('class'));
            })
            var active = localStorage.getItem("linkActive");
            $('.' + active).addClass('active')
            if (localStorage.getItem("setGlobalNamaFilter") != '') {
                var nama_search = localStorage.getItem("setGlobalNamaFilter");
                $('.filter-nama-global').val(nama_search)
            }

            $(document).on('click','.modal-register',function(){
                $('#modal-login').modal('hide');
                $('#modal-register').modal('show');
            })

        })

        function renderRp(nilai, decimal) {
            return accounting.formatNumber(nilai, decimal, " ");
        }

        function setGlobalKategoriFilter(val) {
            let id_kategori = $(val).attr('data-id');
            localStorage.setItem("filterKateoriGlobal", id_kategori);
            window.location.href = "{{ url('shop') }}"
        }

        function setGlobalNamaFilter() {
            var nama = $('.filter-nama-global').val();
            if (nama != '') {
                localStorage.setItem("setGlobalNamaFilter", nama);
            } else {
                localStorage.setItem("setGlobalNamaFilter", '');
            }
            window.location.href = "{{ url('shop') }}"
        }
        var id_user = $('meta[name="id_user"]').attr('content');

    </script>
 @toastr_render
    @yield('js')


</body>

</html>
