@extends('admin.template_index')
@section('template_index')
<style>
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding-left: 10px;
        height: auto;
        margin-top: -9px;
    }

</style>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Setting Lokasi Awal Pengiriman</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Setting Lokasi Awal Pengiriman</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <form method="post" action="{{ route('setting-pengiriman.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- <div class="col-sm-3 form-group">
                            <label>Kabupaten</label>
                            <select name="id_kabupaten" class="id_kabupaten form-control">
                                @if(!empty( setPengiriman()->id_kabupaten) )
                                <option value="{{ setPengiriman()->id_kabupaten }}">
                                    {{ setPengiriman()->nama_kabupaten }}</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>Kecamatan</label>
                            <select name="id_kecamatan" class="id_kecamatan form-control">
                                @if(!empty( setPengiriman()->id_kabupaten) )
                                <option value="{{ setPengiriman()->id_kecamatan }}">
                                    {{ setPengiriman()->nama_kecamatan }}</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>Desa</label>
                            <select name="id_desa" class="id_desa form-control">
                                @if(!empty( setPengiriman()->id_kabupaten) )
                                <option value="{{ setPengiriman()->id_desa }}">{{ setPengiriman()->nama_desa }}</option>
                                @endif
                            </select>
                        </div> -->
                        <div class="col-sm-3 form-group">
                            <label>Tarif Dalam Ujungpangkah</label>
                            <input name="harga_dalam" value="{{ !empty( setPengiriman()->harga_dalam ) ? setPengiriman()->harga_dalam : 0 }}" data-inputmask="'alias': 'currency', 'prefix': '','digits': '2'"
                                class="form-control form-control-sm input-mask" />
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>Tarif Dalam Ujungpangkah</label>
                            <input name="harga_luar" value="{{ !empty( setPengiriman()->harga_luar ) ? setPengiriman()->harga_luar : 0 }}" data-inputmask="'alias': 'currency', 'prefix': '','digits': '2'"
                                class="form-control form-control-sm input-mask" />
                        </div>

                    </div>
                    <!-- <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Gambar 2</label>
                            <input name="gambar_utama[gambar_t1]" type="file" class="foto-dashboard1" />
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Gambar 3</label>
                            <input name="gambar_utama[gambar_t2]" type="file" class="foto-dashboard2" />
                        </div>
                    </div> -->
                    <div class="row">
                        <div class="col-sm-12 form-group text-right">
                            <hr>
                            <button type="submit" class="btn btn-sm btn-success">Perbarui</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

@endsection
@section('js')

<script>
    let kode_kabupaten = 0;
    let kode_kecamatan = 0;
    $(document).ready(function () {
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
                    params.kode_kabupaten = kode_kabupaten;
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
    })

</script>
@endsection
