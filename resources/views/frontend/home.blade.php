@extends('layouts.web')

@section('title')
    Halaman Utama
@endsection
@section('nav_bottom_btn')
    <a href="{{ route('web.checkout') }}" class="ms-auto btn btn-danger full-round px-4 my-auto">
        <small>Lanjut</small>
    </a>
@endsection
@section('script')
    <script>
        function viewMore() {
            var index_temp = $('#total_product_list').val()
            var index_now = parseInt(index_temp) + parseInt('{{ $data['total_show'] }}')
            $('#total_product_list').val(index_temp)

            if ('{{ isset($_GET['category']) }}') {
                var category_name = $('#category_name').val()
            } else {
                var category_name = $('#category_name').val()
            }

            if ('{{ isset($_GET['product']) }}') {
                var product = $('#product').val()
            } else {
                var product = ''
            }

            $.ajax({
                type: "get",
                url: '{{ route('web.more') }}',
                data: {
                    start: index_temp,
                    end: index_now,
                    category_name: category_name,
                    product: product
                },
                success: function(response) {
                    Object.entries(response).forEach(([key, val]) => {
                        if (val.thumbnail == '') {
                            var srcThumbnail = "{{ asset('app-assets/image/default-4-3.png') }}"
                            var thumbnail = `<img loading="lazy" class="w-100 product-image"
                                    src="` + srcThumbnail + `"
                                    alt="` + srcThumbnail + `">`
                        } else {
                            var srcThumbnail =
                                "{{ route('storage.productThumbnail', ['filename' => ':filename']) }}"
                                .replaceAll(':filename', val.thumbnail)
                            var thumbnail = `<img loading="lazy" class="w-100 product-image"
                                    src="` + srcThumbnail + `"
                                    alt="` + val.thumbnail + `">`
                        }

                        var new_key = parseInt(index_temp) + parseInt(key)
                        $('#product_list').append(`
                        <div class="row m-0">
                            <div class="col-5 col-md-3 col-lg-2">` + thumbnail + `</div>
                            <div class="col-7 col-md-9 col-lg-10">
                                <h6 class="fw-bold my-0">` + val.name + `</h6>
                                <small class="text-danger fw-bold">Rp` + numberFormat(val.price) + `</small>
                                <input type="hidden" id="product_price_` + (new_key) + `" value="` + val.price + `">
                                <div class="d-flex mt-3">
                                    <button
                                    type="button"
                                    style="width: 40px !important;height: 40px !important"
                                    onclick="min('#input_` + (new_key) + `','#product_price_` + (new_key) + `',` + val
                            .id + `,'` + val.name + `','` + val.thumbnail + `')" class="btn btn-secondary me-2 full-round ms-auto">-</button>

                                    <input type="text" id="input_` + (new_key) + `" class="form-control" value="0" style="width: 60px !important;height: 40px !important;text-align: center !important" readonly>

                                    <button
                                    type="button"
                                    style="width: 40px !important;height: 40px !important"
                                    onclick="plus('#input_` + (new_key) + `','#product_price_` + (new_key) + `',` + val
                            .id + `,'` + val.name + `','` + val.thumbnail + `')" class="btn btn-danger ms-2 full-round">+</button>
                                </div>
                            </div>
                        </div>
                        <hr>
                    `)
                    })
                    if (response.length < parseInt('{{ $data['total_show'] }}')) {
                        $('#btn_more').addClass('d-none')
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown)
                }
            });
            // console.log(index_temp,index_now)
            $('#total_product_list').val(index_now)
        }
    </script>
@endsection
@section('content')
    <div class="container px-0">
        @if (isset($_GET['product']) == false)
            <div id="bannerCarousel" class="carousel slide" data-bs-ride="true">
                <div class="carousel-inner">
                    @if (count($data['banner']) == 0)
                        <div class="carousel-item active px-0 px-md-2">
                            <img loading="lazy" src="{{ asset('app-assets/image/web-default-3-1.png') }}" title="gambar banner"
                                alt="Default 3x1" class="round-sm image-banner d-block w-100">
                        </div>
                    @else
                        @foreach ($data['banner'] as $key => $value)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }} px-0 px-md-2">
                                <img loading="lazy" src="{{ route('storage.bannerImage', ['filename' => $value->banner]) }}"
                                    alt="{{ $value->banner }}" title="banner {{ $value->banner }}"
                                    class="round-sm image-banner d-block w-100">
                            </div>
                        @endforeach
                    @endif
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <br>
        @endif
        <div class="px-0 px-md-2">
            <div class="slicker">
                @foreach ($data['category'] as $value)
                    <div class="mx-2">
                        @php
                            if ($value->thumbnail == '') {
                                $thumbnail = asset('app-assets/image/web-default-3-1.png');
                            } else {
                                $thumbnail = route('storage.categoryThumbnail', ['filename' => $value->thumbnail]);
                            }
                        @endphp
                        <a href="{{ route('web.index') }}?category={{ $value->name }}"
                            title="Kategori {{ $value->name }}" class="col-6 text-decoration-none text-dark">
                            <div class="round-sm d-flex"
                                style="background-image: url({{ $thumbnail }});
                                background-position: center;
                                background-repeat: no-repeat;
                                background-size: cover;
                                aspect-ratio:3/1">
                                <h6 class="text-category m-auto text-dark p-2 bg-warning">{{ $value->name }}</h6>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="">
            <div class="header bg-white px-0 py-4">
                @php
                    if (isset($_GET['product'])) {
                        $desc = 'Hasil pencarian:';
                        if ($_GET['product'] == '') {
                            $name = 'Kolom pencarian kosong';
                        } else {
                            $name = str_replace('+', ' ', $_GET['product']);
                        }
                    } else {
                        $desc = '';
                        if (isset($_GET['category'])) {
                            $name = $_GET['category'];
                        } else {
                            $name = '';
                        }
                    }
                @endphp
                <div class="{{ $desc == '' ? 'd-none' : '' }}">
                    <small>{{ $desc }}</small><br><br>
                </div>
                @if ($name != '')
                    <p6 class="bg-danger py-2 px-4 text-white rounded">
                        {{ $name }}
                    </p6>
                @endif
            </div>
            <input type="hidden" id="total_product_list" value="{{ count($data['product']) }}">
            <input type="hidden" id="category_name" value="{{ $name }}">
            <input type="hidden" id="product" value="{{ isset($_GET['product']) ? $_GET['product'] : '' }}">
            <div class="body px-0 py-2" id="product_list">
                @if (count($data['product']) == 0)
                    <div class="row m-0 text-center">
                        @include('frontend.includes.loading')
                        <h4>Opps, data yang kamu cari belum tersedia</h4>
                    </div>
                @else
                    @foreach ($data['product'] as $key => $val)
                        <div class="row m-0">
                            <div class="col-5 col-md-3 col-lg-2">
                                @if ($val->thumbnail == '')
                                    <img loading="lazy" class="w-100 product-image" title="gambar produk"
                                        src="{{ asset('app-assets/image/web-default-4-3.png') }}"
                                        alt="{{ asset('app-assets/image/web-default-4-3.png') }}">
                                @else
                                    <img loading="lazy" class="w-100 product-image" title="gambar produk {{ $val->name }}"
                                        src="{{ route('storage.productThumbnail', ['filename' => $val->thumbnail]) }}"
                                        alt="{{ $val->thumbnail }}">
                                @endif
                            </div>
                            <div class="col-7 col-md-9 col-lg-10">
                                <h6 class="fw-bold my-0">{{ $val->name }}</h6>
                                <small class="text-danger fw-bold">Rp{{ numberFormat($val->price) }}</small>
                                <input type="hidden" id="product_price_{{ $key }}" value="{{ $val->price }}">
                                <div class="d-flex mt-3">
                                    <button type="button" style="width: 40px !important;height: 40px !important"
                                        onclick="min('#input_{{ $key }}','#product_price_{{ $key }}','{{ $val->id }}','{{ $val->name }}','{{ $val->thumbnail }}')"
                                        class="btn btn-secondary me-2 full-round ms-auto">-</button>
                                    <input type="text" id="input_{{ $key }}" class="form-control"
                                        value="0"
                                        style="width: 60px !important;text-align: center !important;height: 40px !important"
                                        readonly>
                                    <button type="button" style="width: 40px !important;height: 40px !important"
                                        onclick="plus('#input_{{ $key }}','#product_price_{{ $key }}','{{ $val->id }}','{{ $val->name }}','{{ $val->thumbnail }}')"
                                        class="btn btn-danger ms-2 full-round">+</button>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                @endif
            </div>
            @if ($data['more'] == true)
                <div class="footer bg-white d-flex px-0 py-2" id="btn_more">
                    <button onclick="viewMore()"
                        class="text-decoration-none full-round btn btn-sm btn-danger text-white mx-auto px-4 py-2">Tampilkan
                        lebih banyak</button>
                </div>
            @endif
        </div>
    </div>
@endsection
