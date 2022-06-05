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
                        <h4>Cari berdasarkan Kategori</h4>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <button data-id="0" class="btn btn-sm btn-light btn-filter-kategori">
                                Tampilkan Semua 
                                </button>
                            </div>
                            @foreach(sliderKategori() as $k)
                            <div class="col-sm-6 form-group">
                                <button data-id="{{ $k->id_kategori_seafood }}" class="btn btn-sm btn-light btn-filter-kategori">
                                {{ $k->nama_kategori }}
                                </button>
                            </div>
                            @endforeach
                        </div>
                      
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <h4><b>Daftar Produk Seafood</b></h4>
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
    let id_kategori = 0;
    $(document).ready(function () {
        // getProduk()
        $(document).on('click', '.pagination a', function (event) {
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

        $(document).on('click','.btn-filter-kategori', function(){
            id_kategori = $(this).attr('data-id');
            getProduk()
        })
    })


    function getProduk() {
        var url = "{{ route('shop.index') }}" + '?page=' + page
        $.ajax({
            url: url,
            method: 'GET',
            data: {
                'sorting': $('.sorting').val(),
                'id_kategori' : id_kategori
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
