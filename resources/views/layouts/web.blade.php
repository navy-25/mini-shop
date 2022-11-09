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
                @yield('nav_bottom_btn')
            </div>
        </nav>
        <nav class="navbar navbar-expand-lg fixed-top bg-danger py-2">
            <div class="container py-2" style="flex-wrap: initial !important">
                <a href="/" class="">
                    @if(getSettings()->logo == '')
                        <img class="brand-logo me-4" src="{{ asset('app-assets/icon/store.png') }}" alt="">
                    @else
                        <img class="brand-logo me-4" src="{{ route('storage.settingLogo',['filename'=>getSettings()->logo]) }}" alt="">
                    @endif
                </a>
                <form action="" class="w-100">
                    <input class="form-control my-auto input-search" type="search" name="product"
                        placeholder="Yuk! cari kebutuhanmu disini" value="{{ isset($_GET['product']) ? $_GET['product'] : '' }}"
                        aria-label="Search">
                </form>
        </nav>
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
                @yield('content')
            </div>
        </div>
        <footer class="bg-dark pt-5 px-5 text-center text-white">
            <br>
            <br>
            <small>
                <b>Offline Store : </b><br>
                {{ getSettings()->address }}<br><br>

                <b>Jam Layanan </b><br>
                {{ getSettings()->service_time }}<br><br>

                <b>Sosial Media </b><br>
                <div class="mt-2">
                    <center>
                        <a target="_blank" href="{{ getSettings()->instagram }}" class="me-2 text-danger {{ getSettings()->instagram == '' ? 'd-none' : ''}} "> <i data-feather="instagram"></i>
                        </a>
                        <a target="_blank" href="{{ getSettings()->facebook }}" class="me-2 text-danger {{ getSettings()->facebook == '' ? 'd-none' : ''}} "> <i data-feather="facebook"></i>
                        </a>
                        <a target="_blank" href="mailto:{{ getSettings()->email }}" class="me-2 text-danger {{ getSettings()->email == '' ? 'd-none' : ''}} "> <i data-feather="mail"></i>
                        </a>

                        @php
                            $no_wa = getSettings()->whatsapp;
                            if($no_wa[0] == 0){
                                $wa = explode('0',$no_wa);
                                $new_wa = [];
                                foreach ($wa as $key => $value) {
                                    if($key == 0){
                                        continue;
                                    }else{
                                        $new_wa[] = $value;
                                    }
                                }
                                $wa = "62".implode('',$new_wa);
                            }else{
                                $wa = $no_wa;
                            }
                        @endphp
                        <a target="_blank" href="https://wa.me/{{ $wa }}" class="me-2 text-danger {{ getSettings()->whatsapp == '' ? 'd-none' : ''}} "> <i data-feather="message-circle"></i>
                        </a>
                        <a target="_blank" href="{{ getSettings()->phone }}" class="me-2 text-danger {{ getSettings()->phone == '' ? 'd-none' : ''}} "> <i data-feather="phone-call"></i>
                        </a>
                    </center>
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
