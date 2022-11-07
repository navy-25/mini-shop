@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-header py-3 px-3">
        <div class="row">
            <div class="col-6 col-md-6 col-lg-6 d-flex">
                <p class="my-auto">{{ $page['title'] }}</p>
            </div>
            <div class="col-6 col-md-6 col-lg-6 d-flex">
                <button type="button" onclick="$('#btn_submit').trigger('click')"
                    class="btn-danger btn ms-auto btn-sm">
                    Simpan
                </button>
            </div>
        </div>
    </div>
    <div class="card-body py-4 px-3">
        <form id="form" action="{{ route('admin.setting.update',['id' => $data->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label required">Nama Toko</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $data->name }}" placeholder="ex. Jaya Abadi">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="service_time" class="form-label required">Hari/Jam Pelayanan</label>
                        <input type="text" name="service_time" id="service_time" class="form-control" value="{{ $data->service_time }}" placeholder="ex. Senin s/d Jumat">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="keywords" class="form-label required">Kata kunci</label>
                        <input type="text" name="keywords" id="keywords" class="form-control" value="{{ $data->keywords }}" placeholder="ex. toko,sembako,sayuran,malang,surabaya">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="phone" class="form-label optional">Telepon (Rumah)</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ $data->phone }}" placeholder="ex. 031087765">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="instagram" class="form-label optional">Instagram (Url Profil)</label>
                        <input type="text" name="instagram" id="instagram" class="form-control" value="{{ $data->instagram }}" placeholder="ex. https://www.instagram.com/jayaAbadi252 ">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="facebook" class="form-label optional">Facbook (Url Profil)</label>
                        <input type="text" name="facebook" id="facebook" class="form-control" value="{{ $data->facebook }}" placeholder="ex. https://www.facebook.com/jayaabadi ">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label optional">Email</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{ $data->email }}" placeholder="ex. jayaabadai252@gmail.com">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="whatsapp" class="form-label required">Whatsapp (Aktif)</label>
                        <input type="text" name="whatsapp" id="whatsapp" class="form-control" value="{{ $data->whatsapp }}" placeholder="ex. 082132521664">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label required">Alamat Lengkap</label>
                        <textarea name="address" class="form-control" id="address" cols="30" rows="3">{{ $data->address }}</textarea>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label optional">Deskripsi Toko</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="3">{{ $data->description }}</textarea>
                    </div>
                </div>
                <div class="col-12">
                    <label for="name" class="form-label optional">Logo</label>
                    <div class="row">
                        <div class="col-12 col-md-2">
                            <a href="#" class="">
                                @if ($data->logo == '')
                                    <img src="{{ asset('app-assets/image/default-1-1.png') }}"
                                        id="thumbnail-upload-img" class="uploadedThumbnail mb-2"
                                        alt="profile image" width="100%" style="aspect-ratio:1:1 !important" />
                                @else
                                    <img src="{{ route('storage.settingLogo',['filename' => $data->logo]) }}"
                                        id="thumbnail-upload-img" class="uploadedThumbnail mb-2"
                                        alt="profile image" width="100%" style="aspect-ratio:1:1 !important" />
                                @endif
                            </a>
                        </div>
                        <div class="col-12 col-md-4">
                            <p class="mb-1">
                                Spesifikasi file: <br>
                                <span class="badge bg-warning text-dark" style="font-weight: normal !important">png</span>
                                <span class="badge bg-warning text-dark" style="font-weight: normal !important">1 : 1</span>
                            </p>
                            <label for="thumbnail-upload" class="btn btn-sm btn-danger mb-75 mt-1 ms-auto"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="unggah foto"
                                style="font-size:10px !important">
                                Unggah
                            </label>
                            <input type="file" id="thumbnail-upload" name="logo" hidden accept=".png" />
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" id="btn_submit" class="btn btn-sm btn-danger d-none">Tambahkan</button>
        </form>
    </div>
</div>
@include('backend.modal.formCategory')
@endsection

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/dataTables.bootstrap5.min.css') }}">
@endsection

@section('custom_js')
    <script src="{{ asset('app-assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(".select2").select2({
            allowClear: true,
            dropdownParent: $('#form'),
            placeholder:'Pilih salah satu',
        });
        var form = $('#form'),
            accountUploadImg = $('#thumbnail-upload-img'),
            accountUploadBtn = $('#thumbnail-upload'),
            accountUserImage = $('.uploadedThumbnail'),
            accountResetBtn = $('#account-reset');

        if (accountUserImage) {
            var resetImage = accountUserImage.attr('src');
            accountUploadBtn.on('change', function (e) {
                var reader = new FileReader(),
                files = e.target.files;
                reader.onload = function () {
                    if (accountUploadImg) {
                        accountUploadImg.attr('src', reader.result);
                    }
                };
                reader.readAsDataURL(files[0]);
            });
            accountResetBtn.on('click', function () {
                accountUserImage.attr('src', resetImage);
            });
        }
    </script>
@endsection

