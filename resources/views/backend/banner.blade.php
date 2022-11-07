@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-header py-3 px-3">
        <div class="row">
            <div class="col-6 col-md-6 col-lg-6 d-flex">
                <p class="my-auto">Daftar {{ $page['title'] }}</p>
            </div>
            <div class="col-6 col-md-6 col-lg-6 d-flex">
                <a title="tambah" href="#" onclick="createData('{{ route('admin.banner.store') }}')"
                    data-bs-toggle="modal" data-bs-target="#modalForm"
                    class="btn-danger btn ms-auto btn-sm">
                    Tambah
                </a>
            </div>
        </div>
    </div>
    <div class="card-body py-4 px-3">
        <div class="table-responsive">
            <table class="table table table-hover table-bordered table-sm display nowrap" id="data-table" style="width: 100%">
                <thead>
                    <tr class="bg-light">
                        <th class="text-center" style="width: 30px">No</th>
                        <th>Thumbnail</th>
                        <th>Status</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@include('backend.modal.formBanner')
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
        var colums_data =
            [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', className: "text-center",orderable: false, searchable: false},
                {data: 'bannerImage', name: 'banners.thumbnail'},
                {data: 'status_data', name: 'banners.status'},
                {data: 'opsi', name: 'opsi',orderable: false, searchable: false},
            ];

        let params_datatable = function(d) {};
        dataTableAjax('#data-table', '{{ route('admin.banner.index') }}', params_datatable, colums_data,[]);

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
        function createData(url){
            $('#status').val('').trigger('change')
            $('#thumbnail').val('')
            $('#form').attr('action',url)
            $(".uploadedThumbnail").attr('src', "{{ asset('app-assets/image/default-3-1.png') }}");
            $(".uploadedThumbnail").css('aspect-ratio', '3/1');
            $('#btn_submit').text('Tambahkan')
        }
        function editData(self,url){
            let data = $('#data-table').DataTable().row( $(self).parent().parent() ).data();
            let thumbnail_path = "{{ route('storage.bannerImage', ['filename' => ':filename']) }}";
            $('#status').val(data.status).trigger('change')
            if(data.banner) {
                $(".uploadedThumbnail").attr('src', thumbnail_path.replace(':filename', data.banner));
                $(".uploadedThumbnail").css('aspect-ratio', '3/1');
            }
            $('#form').attr('action',url)
            $('#btn_submit').text('Simpan')
        }
    </script>
@endsection

