@foreach($data as $k)
<div class="col-lg-3 col-md-6 col-sm-6">
    <div class="product__item">
        <div class="product__item__pic set-bg" data-setbg="{{ asset('produk/'. $k->file_sampul) }}"
        style="background-image: url( {{ asset('produk/'. $k->file_sampul) }} )">
            <ul class="product__item__pic__hover">
                <li><a data-id="{{ $k->id_barang }}" class="btn-add-to-chart" type="button"><i
                            class="fa fa-shopping-cart"></i></a></li>
            </ul>
        </div>
        <div class="product__item__text text-left">
            <h6><a href="{{ url('detail/barang/'.$k->id_barang) }}">{{ $k->nama_barang }} </a></h6>
            <h5>Rp {{ number_format($k->harga_barang,0) }} ( {{ $k->satuan_barang }} )</h5>
            <small>Penjual : {{ $k->name }}</small><br>
            <small>Stock : {{ abs(number_format($k->stock,0)) }} - </small>
            <small>Terjual : {{ abs(number_format($k->terjual,0)) }}</small>
        </div>
    </div>
</div>
@endforeach
<div class="col-sm-12">
    {!! $data->links() !!}

</div>
