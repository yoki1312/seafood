@extends('admin.template_index')
@section('template_index')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Contact us</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Contact us</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">

    <!-- Default box -->
    <form method="post" action="{{ route('contactUs.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">

            <div class="card-body row">
                <div class="col-5 text-center d-flex align-items-center justify-content-center">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="inputName">Gambar</label>
                                <input name="gambar" type="file" id="inputName" class="form-control gambar" require>
                            </div>
                            <div class="form-group">
                                <div class="text-center">
                                    <img style="max-width: 80%;"
                                        src="{{ asset('foto-contact-us/'. getContackUs()->gambar) }}"
                                        alt="User profile picture">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-7">
                    <div class="form-group">
                        <label for="inputName">Judul</label>
                        <input name="judul" type="text" id="inputName" class="form-control form-control-sm"
                            value="{{ getContackUs()->judul }}" require>
                    </div>
                    <div class="form-group">
                        <label for="inputName">Email Center</label>
                        <input name="email_center" type="email" id="inputName" class="form-control form-control-sm"
                            value="{{ getContackUs()->email_center }}" require>
                    </div>
                    <div class="form-group">
                        <label for="inputName">Telp Center</label>
                        <input name="telp_center" type="text" id="inputName" class="form-control form-control-sm"
                            value="{{ getContackUs()->telp_center }}" require>
                    </div>
                    <div class="form-group">
                        <label for="inputName">Nama Bank</label>
                        <input name="nama_bank" type="text" id="inputName" class="form-control form-control-sm"
                            value="{{ getContackUs()->nama_bank }}" require>
                    </div>
                    <div class="form-group">
                        <label for="inputName">Nama Pemilik Rekening</label>
                        <input name="nama_rekening" type="text" id="inputName" class="form-control form-control-sm"
                            value="{{ getContackUs()->nama_rekening }}" require>
                    </div>
                    <div class="form-group">
                        <label for="inputName">Nomor Rekening</label>
                        <input name="no_rekening" type="text" id="inputName" class="form-control form-control-sm"
                            value="{{ getContackUs()->no_rekening }}" require>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Alamat Center</label>
                        <input name="alamat_center" type="text" id="inputName" class="form-control form-control-sm"
                            value="{{ getContackUs()->alamat_center }}" require>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Keterangan</label>
                        <textarea name="keterangan" id="inputMessage" class="form-control" rows="4"
                            require>{{ getContackUs()->keterangan }}</textarea>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-sm btn-success" type="submit">Simpan</button>
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
        $(".gambar").fileinput({
            'showUpload': false,
            'previewFileType': 'any'
        });
    })

</script>
@endsection
