@extends('front.index')
@section('front')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('assetFront/img/breadcrumb.webp') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Detail Barang</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Detail Barang</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large" style="max-height: 550px;" src="{{ asset('produk/'. $data->file_sampul) }}" alt="">
                        
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        @if(count($file) > 1)
                        @foreach($file as $k)
                        <img data-imgbigurl="{{ asset('produk/'. $k->file) }}" src="{{ asset('produk/'. $k->file) }}"
                            alt="">
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <input type="text" class="id_barang" value="{{ $data->id_barang }}" hidden />
                    <h3>{{ $data->nama_barang }}</h3>
                    <div class="product__details__price">Harga Rp {{ number_format($data->harga_barang,0) }} ({{ $data->satuan_barang }})</div>
                    <p>{{ $data->deskripsi_barang }}.</p>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button class="input-group-text button-qty" data-tipe="min"
                                        id="basic-addon1">-</button>
                                </div>
                                <input readonly type="text" class="form-control text-center total-qty"
                                    placeholder="Username" aria-label="Username" aria-describedby="basic-addon1"
                                    value="1">
                                <div class="input-group-prepend">
                                    <button class="input-group-text button-qty" data-tipe="plus"
                                        id="basic-addon1">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <button class="btn btn-success btn-add-to-chart" data-id="{{ $data->id_barang }}"
                                data-jenis="detail">Tambah Ke Pesanan</button>

                        </div>
                    </div>
                    <!-- <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a> -->
                    <ul>
                        <input type="hidden" class="stock-barang" value="{{ number_format($data->stock,0) }}" />
                        <li><b>Toko</b> <span>{{ $data->name }} </li>
                        <li><b>Tersedia</b> <span>In {{ number_format($data->stock,0) }} Stock</span></li>
                        <li><b>Terjual</b> <span>{{ abs($data->terjual) }} </li>
                        <li><b>Kategori</b> <span>{{ $data->nama_kategori }} </li>
                        <!-- <li><b>Weight</b> <span>0.5 kg</span></li>
                        <li><b>Share on</b>
                            <div class="share">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </li> -->
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                aria-selected="false">Komentar Produk <span class="total-komentar"></span></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc komentar-user">
                                <div class="row">
                                    <div class="col-sm-12  row-komentar"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="product__details__tab__desc" style="padding-top: 0px !important;">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h6>Tambah Komentar</h6>
                                        <textarea class="komentar-value" id="text-komentar"></textarea><br>
                                    </div>
                                    <div class="col-sm-12 text-right">
                                        <button data-id="{{ $data->id_barang }}" type="button"
                                            class="btn btn-sm btn-success btn-kirim-komentar">Kirim Komentar</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<hr>
<!-- Product Details Section End -->

<!-- Related Product Section Begin -->
@if(count($produkSerupa) > 0)
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Produk Sejenis </h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($produkSerupa as $t)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{ asset('produk/'. $t->file_sampul) }}">
                        <ul class="product__item__pic__hover">
                            <li><a data-id="{{ $t->id_barang }}" class="btn-add-to-chart" type="button"><i
                                        class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="{{ url('detail/barang/'.$t->id_barang) }}">{{ $t->nama_barang }} </a></h6>
                        <h5>Rp {{ number_format($t->harga_barang,0) }} ({{ $t->satuan_barang }})</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
@section('js')
<script>
    $(document).ready(function () {
        $('#text-komentar').summernote();
        getKomentarProduk()
        $(document).on('click', '.btn-kirim-komentar', function () {
            let id_barang = $(this).attr('data-id');
            var url = '{{ url("add/item/komentar") }}';
            var id_user = '{{ isset(Auth::user()->id) ? Auth::user()->id : 0 }}';
            if (id_user == 0) {
                return Swal.fire('Silahkan Login terlebih dahulu!', )
            }
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    id_barang: id_barang,
                    komentar: $('.komentar-value').val()
                },
                success: function (response) {
                    getKomentarProduk();
                    $('.komentar-value').summernote('reset');

                },
                error: function (error) {
                    console.log(error)
                }
            });
        })
        $(document).on('click', '.btn-remove-komentar', function () {
            let id_koment = $(this).attr('koment-id');
            Swal.fire({
                title: 'Are you sure?',
                //   text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = '{{ url("hapus/item/komentar/") }}' + '/' + id_koment;
                    $.ajax({
                        url: url,
                        method: 'POST',
                        success: function (response) {
                            Swal.fire(
                                'Deleted!',
                                'Your koment has been deleted.',
                                'success'
                            )
                            getKomentarProduk()
                        },
                        error: function (error) {
                            console.log(error)
                        }
                    });

                }
            })
        });
        $(document).on('click', '.btn-add-to-chart', function () {
            var url = '{{ url("add/item/cekout") }}';
            var id_user = '{{ isset(Auth::user()->id) ? Auth::user()->id : 0 }}'
            var jenis_pesanan = $(this).attr('data-jenis') || 0;
            if (id_user == 0) {
                return Swal.fire('Silahkan Login terlebih dahulu!', )
            }
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    id_barang: $(this).attr('data-id'),
                    qty: jenis_pesanan == 'detail' ? $('.total-qty').val() : 1
                },
                success: function (response) {
                    if (response.status == true) {
                        $('.dt-krs').text(response.totalData)
                        Swal.fire(
                            'Barang berhasil ditambahkan!',
                        )
                    } else {
                        Swal.fire(
                            'Warning!',
                            'Pesanan tidak boleh melebihi stock.',
                            'warning'
                        )
                    }
                },
                error: function (error) {
                    console.log(error)
                }
            });
        });
        $(document).on('click', '.button-qty', function () {
            var type = $(this).attr('data-tipe');
            let qty_pesan = $('.total-qty');
            let total_pesanan = 0;
            let stock_barang = parseFloat($('.stock-barang').val());
            if (type == 'min') {
                const qty_now = qty_pesan.val();
                total_pesanan = parseFloat(qty_now - 1);
            } else if (type == 'plus') {
                let qty_now = parseFloat(qty_pesan.val());
                total_pesanan = qty_now + 1;
            }
            if (total_pesanan <= 0) {
                qty_pesan.val('1');
            } else if (total_pesanan > stock_barang) {
                Swal.fire(
                    'Warning!',
                    'Pesanan tidak boleh melebihi stock.',
                    'warning'
                )
            } else {
                qty_pesan.val(total_pesanan);
            }
        })
    })

    function getKomentarProduk() {
        let id_barang = $('.id_barang').val();
        var url = '{{ url("get/item/komentar/") }}' + '/' + id_barang;
        $.ajax({
            url: url,
            method: 'POST',
            success: function (response) {
                $('.row-komentar').empty()
                response.data.forEach((pro) => {
                    var template =
                        '<div class="col-sm-12" style="border: 1px #ebebeb solid;border-radius: 5px;padding: 15px;"> <div class="row" style="background: #f2f2f2;"><div class="col-sm-6 text-left"><b>Komentar Oleh : ' +
                        pro.name + '</b><p><small>Tanggal komentar : ' + pro.created_at +
                        '</small></p></div><div class="col-sm-6 text-right div-auth-' + pro
                        .id_komentar + '"><button koment-id="' + pro.id_komentar +
                        '" class="btn btn-sm btn-danger btn-remove-komentar"><i class="fa fa-trash"></i></button></div></div><hr> ' +
                        pro.komentar + ' </div><br>'
                    $('.row-komentar').append(template)
                    if (id_user != pro.id_user) {
                        $('.div-auth-' + pro.id_komentar).remove();
                    }
                })
                var total_komentar = response.data.length;
                $('.total-komentar').text('(' + total_komentar + ')');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

</script>
@endsection
