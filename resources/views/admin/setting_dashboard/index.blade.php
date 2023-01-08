@extends('admin.template_index')
@section('template_index')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Setting Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Setting Dashboard</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <form method="post" action="{{ route('gambarDahsboard.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label>Gambar 1</label>
                            <input name="gambar_utama[file]" type="file" class="foto-dashboard" />
                        </div>
                        <div class="col-sm-3 form-group" style="display: none;">
                            <label>Gambar 2</label>
                            <input name="gambar_utama[gambar_t1]" type="file" class="foto-dashboard" />
                        </div>
                        <div class="col-sm-3 form-group" style="display: none;">
                            <label>Gambar 3</label>
                            <input name="gambar_utama[gambar_t2]" type="file" class="foto-dashboard" />
                        </div>
                        <div class="col-sm-6 form-group">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Judul</label>
                                <input name="gambar_utama[judul]" type="text" class="form-control"
                                    id="exampleInputEmail1" aria-describedby="emailHelp" value="{{  isset(getGambarDashboard()->judul) ? getGambarDashboard()->judul : '' }}" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Caption</label>
                                <textarea class="sumernote" name="gambar_utama[caption]">{{ isset(getGambarDashboard()->caption) ? getGambarDashboard()->caption : '' }}</textarea>
                            </div>
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
    $(document).ready(function () {
        $(".foto-dashboard").fileinput({
            'showUpload': false,
            'previewFileType': 'any',
            initialPreviewAsData: true,
            initialPreview: "{{ asset('gambar-dashboard/'. (isset(getGambarDashboard()->gambar) ? getGambarDashboard()->gambar : '' ) ) }}",
            preferIconicZoomPreview : false
        });
        $('.sumernote').summernote({
           
        });
    })

</script>
@endsection
