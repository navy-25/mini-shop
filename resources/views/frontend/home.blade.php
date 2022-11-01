<!doctype html>
<html lang="en">
    <head>
        @include('frontend.includes.head')
    </head>
    <body>
        <nav class="navbar fixed-bottom bg-light">
            <div class="container" style="flex-wrap: initial !important">
                <a type="button" class="position-relative me-3">
                    <i class="me-2 text-danger" data-feather="shopping-cart"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="total_product">
                        0
                    </span>
                </a>
                <div class="d-flex me-auto">
                    <div class="my-auto">
                        <p class="m-0 p-0" style="font-size: 10px !important">Total Belanja</p>
                        <p class="fw-bold m-0 p-0" id="nominal_product" style="font-size: 13px !important">Rp. 0</p>
                    </div>
                </div>
                <a href="/" class="btn btn-danger mx-auto p-3 full-round d-block d-md-none">
                    <i class="" data-feather="home"></i>
                </a>
                <button class="ms-auto btn btn-danger d-flex full-round ps-4 pe-2">
                    <small>Lanjut</small>
                    <i class="me-0" data-feather="chevron-right"></i>
                </button>
            </div>
        </nav>
        <nav class="navbar navbar-expand-lg fixed-top bg-danger py-2">
            <div class="container py-2" style="flex-wrap: initial !important">
                <a href="/" class="">
                    <img class="brand-logo me-4" src="{{ asset('app-assets/icon/store.png') }}" alt="">
                </a>
                <form action="" class="w-100">
                    <input class="form-control my-auto input-search" type="search" name="product"
                        placeholder="Yuk! cari kebutuhanmu disini" value="{{ isset($_GET['product']) ? $_GET['product'] : '' }}"
                        aria-label="Search">
                </form>
                {{-- <button onclick="showMenu()" class="ms-4 btn btn-outline-light px-3 py-2 d-flex full-round">
                    <i data-feather="menu" id="menu" class="m-auto p-0" width="15"></i>
                    <i data-feather="x" id="close" class="m-auto p-0 d-none" width="15"></i>
                </button> --}}
            </div>
        </nav>
        {{-- <div class="bg-dropdown d-none" id="dropdown-nav">
            <ul class="fw-bold text-white p-0 m-0" style="list-style: none !important">
                <li class="py-3 d-flex w-100 m-0">
                    <a href="#" class="mx-auto text-decoration-none text-white">
                        <i class="me-2" data-feather="user"></i> Tentang Kami
                    </a>
                </li>
                <li class="py-3 d-flex w-100 m-0">
                    <a href="#" class="mx-auto text-decoration-none text-white">
                        <i class="me-2" data-feather="book"></i> Syarat & Ketentuan
                    </a>
                </li>
            </ul>
        </div> --}}
        <div id="spinner">
            <div class="d-flex h-100 w-100">
                <div class="loading-parrent m-auto">
                    <div class="loading-object">
                        <div></div><div></div><div></div><div></div><div></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="content h-100-vh py-3 py-md-4 mx-auto">
                <div class="container px-0">
                    @if (isset($_GET['product']) == false)
                        <div id="bannerCarousel" class="carousel slide" data-bs-ride="true">
                            <div class="carousel-inner">
                                @foreach (range(1,3) as $key)
                                    <div class="carousel-item {{ $key == 1 ? 'active' : '' }} px-2">
                                        <img src="{{ asset('app-assets/image/web-default-3-1.png') }}"
                                            alt="{{ asset('app-assets/image/web-default-3-1.png') }}"
                                            class="round-sm image-banner d-block w-100">
                                    </div>
                                @endforeach
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
                        <div id="categoryCarousel" class="carousel slide" data-bs-ride="true">
                            <div class="carousel-inner">
                                @for ($i = 0; $i < count($data['category']) ; $i=$i+2)
                                    @php
                                        $data1 = $data['category'][$i];
                                        if($data1->thumbnail == ''){
                                            $thumbnail_1 = asset('app-assets/image/web-default-3-1.png');
                                        }else{
                                            $thumbnail_1 = route('storage.categoryThumbnail',['filename' => $data1->thumbnail]);
                                        }

                                        try {
                                            $data2 = $data['category'][$i+1];
                                        } catch (\Throwable $th) {
                                            $data2 = $data['category'][0];
                                        }
                                        if($data2->thumbnail == ''){
                                            $thumbnail_2 = asset('app-assets/image/web-default-3-1.png');
                                        }else{
                                            $thumbnail_2 = route('storage.categoryThumbnail',['filename' => $data2->thumbnail]);
                                        }
                                    @endphp
                                    <div class="carousel-item {{ $i == 0 ? 'active' : '' }} px-2">
                                        <div class="row">
                                            <a href="{{ route('web.index') }}?category={{ $data1->name }}" class="col-6 text-decoration-none text-dark">
                                                <div class="round-sm d-flex"
                                                    style="background-image: url({{ $thumbnail_1 }});
                                                        background-position: center;
                                                        background-repeat: no-repeat;
                                                        background-size: cover;
                                                        aspect-ratio:3/1">
                                                    <h6 class="text-category m-auto text-dark p-2 bg-warning">{{ $data1->name }}</h6>
                                                </div>
                                            </a>
                                            <a href="{{ route('web.index') }}?category={{ $data2->name }}" class="col-6 text-decoration-none text-dark">
                                                <div class="round-sm d-flex"
                                                    style="background-image: url({{ $thumbnail_2 }});
                                                        background-position: center;
                                                        background-repeat: no-repeat;
                                                        background-size: cover;
                                                        aspect-ratio:3/1">
                                                    <h6 class="text-category m-auto text-dark p-2 bg-warning">{{ $data2->name }}</h6>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#categoryCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon me-auto btn btn-danger p-2 full-round" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#categoryCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon ms-auto btn btn-danger p-2 full-round" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="">
                        <div class="header bg-white px-2 py-4">
                            @php
                                if(isset($_GET['product']) ){
                                    $desc = 'Hasil pencarian:';
                                    if($_GET['product'] == ''){
                                        $name = 'Kolom pencarian kosong';
                                    }else{
                                        $name = str_replace('+',' ',$_GET['product']);
                                    }
                                }else{
                                    $desc = '';
                                    if(isset($_GET['category'])){
                                        $name = $_GET['category'];
                                    }else{
                                        $name = $data['category'][0]->name;
                                    }
                                }
                            @endphp
                            <div class="{{ $desc == '' ? 'd-none' : '' }}">
                                <small>{{ $desc }}</small><br><br>
                            </div>
                            <p6 class="bg-danger py-2 px-4 text-white rounded">
                                {{ $name }}
                            </p6>
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
                                                <img class="w-100 product-image"
                                                    src="{{ asset('app-assets/image/web-default-4-3.png') }}"
                                                    alt="{{ asset('app-assets/image/web-default-4-3.png') }}">
                                            @else
                                                <img class="w-100 product-image"
                                                    src="{{ route('storage.productThumbnail',['filename' => $val->thumbnail]) }}"
                                                    alt="{{ $val->thumbnail }}">
                                            @endif
                                        </div>
                                        <div class="col-7 col-md-9 col-lg-10">
                                            <h6 class="fw-bold my-0">{{ $val->name }}</h6>
                                            <small class="text-danger fw-bold">Rp. {{ numberFormat($val->price) }}</small>
                                            <input type="hidden" id="product_price_{{ $key }}" value="{{ $val->price }}">
                                            <div class="d-flex mt-3">
                                                <button onclick="min('#input_{{ $key }}','#product_price_{{ $key }}')" class="btn btn-secondary me-2 full-round ms-auto">-</button>
                                                <input type="text" id="input_{{ $key }}" class="form-control" value="0" style="width: 60px !important;text-align: center !important" readonly>
                                                <button onclick="plus('#input_{{ $key }}','#product_price_{{ $key }}')" class="btn btn-danger ms-2 full-round">+</button>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            @endif
                        </div>
                        @if($data['more'] == true)
                            <div class="footer bg-white d-flex px-0 py-2" id="btn_more">
                                <button onclick="viewMore()" class="text-decoration-none full-round btn btn-sm btn-danger text-white mx-auto px-4 py-2">Tampilkan lebih banyak</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <footer class="bg-dark pt-5 px-5 text-center text-white">
            <br>
            <br>
            <small>
                <b>Offline Store : </b><br>
                Toko Sayur Malang, Lantai 2 Pasar Terpadu Dinoyo. <br><br>

                <b>Jam Layanan </b><br>
                Online 06.00 - 18.00 WIB <br><br>

                <b>Sosial Media </b><br>
                <div class="d-flex mt-2">
                    <a href="#" class="ms-auto me-3 text-danger">
                        <i data-feather="instagram"></i>
                    </a>
                    <a href="#" class="me-3 text-danger">
                        <i data-feather="facebook"></i>
                    </a>
                    <a href="#" class="me-3 text-danger">
                        <i data-feather="mail"></i>
                    </a>
                    <a href="#" class="me-auto text-danger">
                        <i data-feather="phone-call"></i>
                    </a>
                </div>
            </small>
            <br>
            <br>
            <br>
            <br>
            <br>
        </footer>
        @include('frontend.includes.script')
    </body>
</html>
