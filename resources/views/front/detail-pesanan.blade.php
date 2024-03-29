@extends('front.index')
@section('front')
<section class="breadcrumb-section set-bg" data-setbg="https://asset-a.grid.id/crop/0x0:0x0/750x500/photo/makemac/2014/06/Wallpaper-iOS-8.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Detail Pesanan</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Detail Pesanan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="shoping-cart spad" style="padding-top:40px !important">
    <form action="{{ route('pesanan.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <div class="checkout__form">
                <h4>Billing Details {{ $header->kode_transaksi }}</h4>
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                           <input type="hidden" name="id_transaksi" value="{{ $header->id_transaksi }}" />
                                <div class="col-lg-6 form-group">
                                    <p>Nama Penerima<span class="text-danger">*</span></p>
                                    <input value="<?= $dataTransaksi->nama ?>" class="form-control form-control-sm" name="nama_depan" type="text" required>
                                </div>
                                <input class="form-control form-control-sm" name="nama_belakang" type="hidden">
                                <!-- <div class="col-lg-6 form-group">
                                    <p>Email<span class="text-danger">*</span></p>
                                    <input value="<?= $dataTransaksi->email ?>" class="form-control form-control-sm" name="email" type="email" required>
                                </div> -->
                                <div class="col-lg-6 form-group">
                                    <p>Nomor Hp<span class="text-danger">*</span></p>
                                    <input class="form-control form-control-sm" value="<?= $dataTransaksi->nomor_hp ?>" name="nomor_hp" type="number" required>
                                </div>
                                <!-- <div class="col-lg-6 form-group">
                                    <p>Kota<span class="text-danger">*</span></p>
                                    <input class="form-control form-control-sm" name="kota" type="text" value="<?= $dataTransaksi->kota ?>" required>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <p>Alamat Lengkap<span class="text-danger">*</span></p>
                                    <textarea style="width:100%" class="form-control" id="" name="alamat_lengkap" cols="30" required><?= $dataTransaksi->alamat_lengkap ?></textarea>
                                </div> -->
                                <div class="col-lg-12 form-group">
                                    <p>Catatan Pembelian</p>
                                    <textarea style="width:100%" class="form-control" id="" name="catatan" cols="30"><?= $dataTransaksi->catatan ?></textarea>
                                </div>
                               
                               

                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h3><b>Your Order</b></h3>
                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Produk</th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total=0; ?>
                                        @foreach($data as $d)
                                        <tr>
                                            <td>{{ $d->nama_barang }}</td>
                                            <td class="text-right">{{ abs(number_format($d->qty,0)) }}</td>
                                            <td class="text-right">{{ number_format($d->harga,0) }}</td>
                                        </tr>
                                        <?php $total += $d->harga; ?>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if(!empty($header->ongkir))
                                    <div class="checkout__order__total">Ongkir <span>Rp {{ number_format($header->ongkir,0) }}</span></div>
                                @endif
                                    <div class="checkout__order__total">Grand Total <span>Rp {{ number_format($total + $header->ongkir,0) }}</span> </div>
                                <div class="checkout__input__checkbox">
                                <small>Nomor Rekening : {{ getContackUs()->no_rekening }} A/n {{ getContackUs()->nama_rekening }}</small><br> 
                                    <small>Nomor Whatsapp :<a target="_blank" href="https://wa.me/{{ getContackUs()->telp_center }}"> {{ getContackUs()->telp_center }}</a></small>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <p>File Pembayaran <span class="text-danger">*</span></p>
                                    @if(!empty($dataTransaksi->file))
                                    <a target="_blank" href={{ asset('file-pembayaran/'.$dataTransaksi->file)}} >Lihat File Pembayaran</a>
                                    @else
                                    <input type="file" name="file" id="payment" required>

                                    @endif
                                </div>
                                @if($header->id_status == 1)
                                <button type="submit" class="site-btn">PLACE ORDER</button>

                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <a href="{{ route('riwayatPesanan.index') }}" class="btn btn-sm btn-danger">Back</a>
                        </div>
                    </div>
            </div>
        </div>
    </form>
</section>

@endsection
@section('js')
<script>
    $(document).ready(function () {
       var id_status = "{{ $header->id_status }}";

       if(id_status != 1){
           $('input').attr('readonly', true);
           $('textarea').attr('disabled', true);
       }
    })

</script>
@endsection
