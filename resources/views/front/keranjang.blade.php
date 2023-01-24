@extends('front.index')
@section('front')
<style>
    .x-hidden {
        display: none;
    }

</style>
<section class="breadcrumb-section set-bg"
    data-setbg="https://asset-a.grid.id/crop/0x0:0x0/750x500/photo/makemac/2014/06/Wallpaper-iOS-8.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Keranjang Pesanan</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Keranjang Pesanan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="shoping-cart spad" style="padding-top:40px !important">
    <form action="{{ route('pesanan.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-sm tb-barang">
                            <thead class="table-primary">
                                <tr>
                                    <th class="text-center">Products</th>
                                    <th class="text-center">Toko</th>
                                    <th class="text-center">Nama Barang</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Sisa Stock</th>
                                    <th class="text-center" style="width: 100px !important;">Quantity</th>
                                    <th class="text-center" style="width: 100px !important;">Total</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <div class="shoping__continue">
                                <div class="shoping__discount">
                                    <h5>Opsi Pengiriman Barang</h5>
                                    <select class="form-control opsi-kirim">
                                        <option value="">Pilih Opsi</option>
                                        <option value="1">Ambil Ditempat</option>
                                        <option value="2">Dikirin ke tujuan</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <!-- <div class="col-lg-4 form-group x-hidden row-pengiriman">
                            <p>Kabupaten <span class="text-danger">*</span></p>
                            <select name="id_kabupaten" class="id_kabupaten form-control form-control-sm">
                            </select>
                        </div> -->
                        <div class="col-lg-6 form-group x-hidden row-pengiriman">
                            <p>Kecamatan <span class="text-danger">*</span></p>
                            <select style="width: 100%;" name="id_kecamatan" class="id_kecamatan form-control form-control-sm">

                            </select>
                        </div>
                        <div class="col-lg-6 form-group x-hidden row-pengiriman">
                            <p>Desa <span class="text-danger">*</span></p>
                            <select style="width: 100%;" name="id_desa" class="id_desa form-control form-control-sm">
                                
                        </select>
                    </div>
                    <div class="col-sm-12 x-hidden row-pengiriman">
                            <p>Detail Alamat <span class="text-danger">*</span></p>
                            <textarea name="alamat" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Jumlah Qty Pesanan <span class="total-qty-pesanan">0</span></li>
                            <li class="x-hidden row-pengiriman">Ongkos Kirim <span class="ongkos-kirim">0</span></li>
                            <li>Total Pembayaran <span class="total-pembayaran-pesanan">0</span></li>
                        </ul>
                        <button type="submit" class="btn btn-sm btn-success" style="width: 100%;">PROCEED TO
                            CHECKOUT</button>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="ongkir" class="ongkir-transaksi" value="0" />
    </form>
</section>

@endsection
@section('js')
<script>
    let ongkir = 0;
    let harga_dalam = "{{ setPengiriman()->harga_dalam }}";
    let harga_luar = "{{ setPengiriman()->harga_luar }}";
    function getongkoskirim() {
        if($('.id_kecamatan').val() != '3796'){
            $('.ongkos-kirim').text( renderRp(harga_luar));
            ongkir = harga_luar * 1;
        }else{
            $('.ongkos-kirim').text( renderRp(harga_dalam));
            ongkir = harga_dalam * 1;
        }
        $('.ongkir-transaksi').val(ongkir);
        renderSummary();
    }
    function renderSummary(){
        let total = 0;
        let i = 0;
        $('.tb-barang').find('tbody').find('tr').each(function(){
          
            if($(this).find('.id-status').val() == 1){
                total += unmaskValue($(this).find('.total-pesanan'));
                i++;
            }
        });
        if($('.opsi-kirim').val() == 1) ongkir = 0;
        let totalAkhir = parseFloat( ongkir + total) ;
        console.log(totalAkhir);
        $('.total-qty-pesanan').text(i + ' barang');
        $('.total-pembayaran-pesanan').text( renderRp(totalAkhir) );
    }
    $(document).ready(function () {
        $(document).on('change', '.opsi-kirim', function () {
            $('.row-pengiriman').hide();
            if ($(this).val() == 2) $('.row-pengiriman').show();
            renderSummary();
        })
        var url = "{{ asset('produk/') }}"
        var table = $('.tb-barang').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            lengthChange: false,
            "ordering": false,
            ajax: "{{ route('pesanan.index') }}",
            columns: [{
                    data: 'file_sampul',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: function (meta, data, row, type) {
                        return '<img style="max-width: 100px;border-radius: 15%" src="' + url +
                            '/' + row
                            .file_sampul + '" />';
                    }
                },
                {
                    data: 'nama_toko',
                    className: 'text-left',
                },
                {
                    data: 'nama_barang',
                    className: 'text-left',
                },
                {
                    data: 'harga_barang',
                    className: 'text-right',
                    render: function (meta, data, row) {
                        return renderRp(row.harga_barang, 0);
                    }
                },
                {
                    data: 'qty',
                    className: 'text-right',
                    render: function (meta, data, row, type) {
                        return renderRp(row.sisa_stock, 0)
                    }
                },
                {
                    data: 'qty',
                    className: 'text-right',
                    render: function (data, type, row, meta) {
                        var elm = '';
                        elm += '<input name="detail_transaksi[' + meta.row +
                            '][status_cekout]" type="hidden" value="0" class="form-control form-control-sm text-right id-status" />';
                        elm += '<input name="detail_transaksi[' + meta.row +
                            '][id_temporary]" type="hidden" value="' + row.id_temporary +
                            '" class="form-control form-control-sm text-right" />';
                        elm += '<input name="detail_transaksi[' + meta.row +
                            '][id_barang]" type="hidden" value="' + row.id_barang +
                            '" class="form-control form-control-sm text-right" />';
                        elm += '<input name="detail_transaksi[' + meta.row +
                            '][stock]" type="hidden" value="' + parseInt(row.sisa_stock) +
                            '" class="form-control form-control-sm text-right sisa-stock" />';
                        elm += '<input name="detail_transaksi[' + meta.row +
                            '][harga_barang]" type="hidden" value="' + row.harga_barang +
                            '" class="form-control form-control-sm text-right harga-barang" />';
                        elm += '<input name="detail_transaksi[' + meta.row +
                            '][qty_pesanan]" ' + (row.sisa_stock <= 0 ? 'readonly' : '') +
                            ' type="number" value="' + parseInt(row.qty) +
                            '" class="form-control form-control-sm text-right qty-pesanan" />';
                        return elm
                    }
                },
                {
                    data: 'qty',
                    className: 'text-right',
                    render: function (data, type, row, meta) {
                        return `<input name="detail_transaksi[${meta.row}][total_pesanan]" readonly type="text" value="${ parseFloat(row.qty * row.harga_barang) }" class="form-control form-control-sm text-right total-pesanan input-mask" data-inputmask="'alias': 'currency', 'prefix': '','digits': '2'" />`;
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    className: 'text-center',
                    orderable: false,
                    searchable: false
                },
            ],
            "rowCallback": function( row, data ) {
                $(row).find(".input-mask").inputmask({
                    removeMaskOnSubmit: true,
                    allowMinus: false
                }).on('focus', function () {
                    $(this).select();
                });
                }
        });

        let totalQtyPesanan = 0;
        let totalPembayaranPesanan = 0;
        $(document).on('click', '.btn-cekout', function () {
            var data = table.row($(this).closest('tr')).data();
            var elm = $(this).closest('tr');
            // let qty = parseFloat(elm.find('.qty-pesanan').val());

            elm.find('.btn-un-cekout').show()
            $(this).hide()
            elm.find('.qty-pesanan').attr('readonly', true)
            elm.find('.id-status').val(1);
            renderSummary()
            
            // totalQtyPesanan = parseFloat(totalQtyPesanan + qty);
            
            // $('.total-qty-pesanan').text(totalQtyPesanan + ' barang');
            
            // var harga = parseFloat(qty * data.harga_barang);
            // totalPembayaranPesanan = totalPembayaranPesanan + harga;
            // totalPembayaranPesanan = parseFloat(totalPembayaranPesanan + ongkir);
            // console.log(totalPembayaranPesanan);
            // $('.total-pembayaran-pesanan').text(renderRp( totalPembayaranPesanan ));
            

        });
        $(document).on('click', '.btn-un-cekout', function () {
            var data = table.row($(this).closest('tr')).data();
            var elm = $(this).closest('tr');
            let qty = parseFloat(elm.find('.qty-pesanan').val());

            $(this).hide()
            elm.find('.btn-cekout').show()
            totalQtyPesanan = parseFloat(totalQtyPesanan - qty);
            $('.total-qty-pesanan').text(totalQtyPesanan + ' barang');

            var harga = parseFloat(qty * data.harga_barang);
            totalPembayaranPesanan = totalPembayaranPesanan - harga;
            $('.total-pembayaran-pesanan').text(renderRp( parseFloat(totalPembayaranPesanan + ongkir)));
            elm.find('.qty-pesanan').attr('readonly', false)
            elm.find('.id-status').val(0)
        });


        $(document).on('change', '.qty-pesanan', function () {
            const elm = $(this).closest('tr');
            let qty = $(this).val();
            let harga = elm.find('.harga-barang').val();
            let sisa_stock = parseInt(elm.find('.sisa-stock').val());
            if (qty > sisa_stock) {
                $(this).val('0');
                elm.find('.total-pesanan').val('0')
                return Swal.fire(
                    'Warning!',
                    'Pesanan tidak boleh melebihi stok yang tersedia.',
                    'warning'
                );
            }
            elm.find('.total-pesanan').val(parseFloat(qty * harga));
            renderSummary();
        })

        $(document).on('click', '.btn-hapus-pesanan', function () {
            let id_pesanan = $(this).attr('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("{{ url('/pesanan/destroy/') }}" + '/' + id_pesanan, function (
                        data) {
                        if (data.success == true) {
                            Swal.fire(
                                'Berhasil!',
                                'Pesanan berhasil dihapus.',
                                'success'
                            );
                            table.ajax.reload(null, true)
                        }
                    });
                }
            })

        })
        let kode_kabupaten = 0;
        let kode_kecamatan = 0;
        $('.id_kabupaten').select2({
            placeholder: 'Pilih Kabupaten',
            maximumSelectionLength: 5,
            allowClear: true,
            ajax: {
                url: "{{ route('setting-pengiriman.ref_kabupaten') }}",
                method: "POST",
                data: function (params) {
                    return params;
                },
                dataType: 'json',
                delay: 1000,
                processResults: function (data) {
                    return {
                        results: data.map(function (item) {
                            item.id = item.id;
                            item.text = item.name;
                            return item;
                        })
                    };
                },
            },
            escapeMarkup: function (m) {
                return m;
            }
        }).on('select2:select', function (e) {
            var data = e.params.data;
            if (data.code != kode_kabupaten) {
                $('.id_kecamatan').val(null).trigger('change');
            }
            kode_kabupaten = data.code;
        }).on('select2:clearing', function (e) {
            kode_kabupaten = 0;
            kode_kecamatan = 0;
            $('.id_kecamatan').val(null).trigger('change');
        });
        $('.id_kecamatan').select2({
            placeholder: 'Pilih Kecamatan',
            maximumSelectionLength: 5,
            allowClear: true,
            ajax: {
                url: "{{ route('setting-pengiriman.ref_kecamatan') }}",
                method: "POST",
                data: function (params) {
                    // params.kode_kabupaten = kode_kabupaten;
                    return params;
                },
                dataType: 'json',
                delay: 1000,
                processResults: function (data) {
                    return {
                        results: data.map(function (item) {
                            item.id = item.id;
                            item.text = item.name;
                            return item;
                        })
                    };
                },
            },
            escapeMarkup: function (m) {
                return m;
            }
        }).on('select2:select', function (e) {
            var data = e.params.data;
            kode_kecamatan = data.code;
            if (data.code != kode_kecamatan) {
                $('.id_desa').val(null).trigger('change');
            }
            getongkoskirim()
        }).on('select2:clearing', function (e) {
            kode_kecamatan = 0;
            $('.id_desa').val(null).trigger('change');
        });
        $('.id_desa').select2({
            placeholder: 'Pilih Desa',
            maximumSelectionLength: 5,
            allowClear: true,
            ajax: {
                url: "{{ route('setting-pengiriman.ref_desa') }}",
                method: "POST",
                data: function (params) {
                    params.kode_kecamatan = kode_kecamatan;
                    return params;
                },
                dataType: 'json',
                delay: 1000,
                processResults: function (data) {
                    return {
                        results: data.map(function (item) {
                            item.id = item.id;
                            item.text = item.name;
                            return item;
                        })
                    };
                },
            },
            escapeMarkup: function (m) {
                return m;
            }
        });
    }).on('change', function(){
       
    })
 

</script>
@endsection
