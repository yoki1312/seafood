@extends('front.index')
@section('front')
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('assetFront/img/breadcrumb.webp')  }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Semua Produk</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Semua Produk</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <div class="latest-product__text">
                            <h4>Latest Products</h4>
                            <div class="latest-product__slider owl-carousel owl-loaded owl-drag">


                                <div class="owl-stage-outer">
                                    <div class="owl-stage"
                                        style="transform: translate3d(-525px, 0px, 0px); transition: all 1.2s ease 0s; width: 1575px;">
                                        <div class="owl-item cloned" style="width: 262.5px;">
                                            <div class="latest-prdouct__slider__item">
                                                <a href="#" class="latest-product__item">
                                                    <div class="latest-product__item__pic">
                                                        <img src="{{  asset('assetFront/img/latest-product/lp-1.jpg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>Crab Pool Security</h6>
                                                        <span>$30.00</span>
                                                    </div>
                                                </a>
                                                <a href="#" class="latest-product__item">
                                                    <div class="latest-product__item__pic">
                                                        <img src="{{  asset('assetFront/img/latest-product/lp-2.jpg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>Crab Pool Security</h6>
                                                        <span>$30.00</span>
                                                    </div>
                                                </a>
                                                <a href="#" class="latest-product__item">
                                                    <div class="latest-product__item__pic">
                                                        <img src="{{  asset('assetFront/img/latest-product/lp-3.jpg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>Crab Pool Security</h6>
                                                        <span>$30.00</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="owl-item cloned" style="width: 262.5px;">
                                            <div class="latest-prdouct__slider__item">
                                                <a href="#" class="latest-product__item">
                                                    <div class="latest-product__item__pic">
                                                        <img src="{{  asset('assetFront/img/latest-product/lp-1.jpg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>Crab Pool Security</h6>
                                                        <span>$30.00</span>
                                                    </div>
                                                </a>
                                                <a href="#" class="latest-product__item">
                                                    <div class="latest-product__item__pic">
                                                        <img src="{{  asset('assetFront/img/latest-product/lp-2.jpg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>Crab Pool Security</h6>
                                                        <span>$30.00</span>
                                                    </div>
                                                </a>
                                                <a href="#" class="latest-product__item">
                                                    <div class="latest-product__item__pic">
                                                        <img src="{{  asset('assetFront/img/latest-product/lp-3.jpg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>Crab Pool Security</h6>
                                                        <span>$30.00</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="owl-item active" style="width: 262.5px;">
                                            <div class="latest-prdouct__slider__item">
                                                <a href="#" class="latest-product__item">
                                                    <div class="latest-product__item__pic">
                                                        <img src="{{  asset('assetFront/img/latest-product/lp-1.jpg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>Crab Pool Security</h6>
                                                        <span>$30.00</span>
                                                    </div>
                                                </a>
                                                <a href="#" class="latest-product__item">
                                                    <div class="latest-product__item__pic">
                                                        <img src="{{  asset('assetFront/img/latest-product/lp-2.jpg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>Crab Pool Security</h6>
                                                        <span>$30.00</span>
                                                    </div>
                                                </a>
                                                <a href="#" class="latest-product__item">
                                                    <div class="latest-product__item__pic">
                                                        <img src="{{  asset('assetFront/img/latest-product/lp-3.jpg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>Crab Pool Security</h6>
                                                        <span>$30.00</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="owl-item" style="width: 262.5px;">
                                            <div class="latest-prdouct__slider__item">
                                                <a href="#" class="latest-product__item">
                                                    <div class="latest-product__item__pic">
                                                        <img src="{{  asset('assetFront/img/latest-product/lp-1.jpg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>Crab Pool Security</h6>
                                                        <span>$30.00</span>
                                                    </div>
                                                </a>
                                                <a href="#" class="latest-product__item">
                                                    <div class="latest-product__item__pic">
                                                        <img src="{{  asset('assetFront/img/latest-product/lp-2.jpg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>Crab Pool Security</h6>
                                                        <span>$30.00</span>
                                                    </div>
                                                </a>
                                                <a href="#" class="latest-product__item">
                                                    <div class="latest-product__item__pic">
                                                        <img src="{{  asset('assetFront/img/latest-product/lp-3.jpg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>Crab Pool Security</h6>
                                                        <span>$30.00</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="owl-item cloned" style="width: 262.5px;">
                                            <div class="latest-prdouct__slider__item">
                                                <a href="#" class="latest-product__item">
                                                    <div class="latest-product__item__pic">
                                                        <img src="{{  asset('assetFront/img/latest-product/lp-1.jpg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>Crab Pool Security</h6>
                                                        <span>$30.00</span>
                                                    </div>
                                                </a>
                                                <a href="#" class="latest-product__item">
                                                    <div class="latest-product__item__pic">
                                                        <img src="{{  asset('assetFront/img/latest-product/lp-2.jpg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>Crab Pool Security</h6>
                                                        <span>$30.00</span>
                                                    </div>
                                                </a>
                                                <a href="#" class="latest-product__item">
                                                    <div class="latest-product__item__pic">
                                                        <img src="{{  asset('assetFront/img/latest-product/lp-3.jpg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>Crab Pool Security</h6>
                                                        <span>$30.00</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="owl-item cloned" style="width: 262.5px;">
                                            <div class="latest-prdouct__slider__item">
                                                <a href="#" class="latest-product__item">
                                                    <div class="latest-product__item__pic">
                                                        <img src="{{  asset('assetFront/img/latest-product/lp-1.jpg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>Crab Pool Security</h6>
                                                        <span>$30.00</span>
                                                    </div>
                                                </a>
                                                <a href="#" class="latest-product__item">
                                                    <div class="latest-product__item__pic">
                                                        <img src="{{  asset('assetFront/img/latest-product/lp-2.jpg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>Crab Pool Security</h6>
                                                        <span>$30.00</span>
                                                    </div>
                                                </a>
                                                <a href="#" class="latest-product__item">
                                                    <div class="latest-product__item__pic">
                                                        <img src="{{  asset('assetFront/img/latest-product/lp-3.jpg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>Crab Pool Security</h6>
                                                        <span>$30.00</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span
                                            class="fa fa-angle-left"><span></span></span></button><button type="button"
                                        role="presentation" class="owl-next"><span
                                            class="fa fa-angle-right"><span></span></span></button></div>
                                <div class="owl-dots disabled"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <h4>Produk</h4>
                <div class="filter__item">
                    <div class="row">
                        <div class="col-lg-4 col-md-5">
                            <div class="filter__sort">
                                <span>Sort By</span>
                                <select class="sorting" onchange="getProduk()">
                                    <option value="1">Terbaru</option>
                                    <option value="2">Terjual Paling Banyak </option>
                                    <option value="3">Stok Paling Banyak </option>
                                </select>
                                <!-- <div class="nice-select" tabindex="0"><span class="current">Default</span>
                                    <ul class="list">
                                        <li data-value="0" class="option selected">Default</li>
                                        <li data-value="0" class="option">Default</li>
                                    </ul>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="filter__found">
                                <h6><span>{{ $total_data }}</span> Produk ditemukan</h6>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="row section-data">
                    @include('front.child_shop')
                </div>
                <!-- <div class="product__pagination">
                </div> -->
            </div>
        </div>
    </div>
</section>

@endsection
@section('js')
<script>
    let page = 1;
    $(document).ready(function(){
        // getProduk()
        $(document).on('click', '.pagination a', function(event){
            event.preventDefault(); 
            page = $(this).attr('href').split('page=')[1];
            getProduk()

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
    })
    function getProduk() {
        var url = "{{ route('shop.index') }}"+ '?page='+page
        $.ajax({
            url: url,
            method: 'GET',
            data : {
                'sorting' : $('.sorting').val()
            },
            success: function (data) {
               $('.section-data').html(data)
            },
            error: function (error) {
                console.log(error)
            }
        });
    }
    

</script>
@endsection
