<!doctype html>
<html lang="en">

<head>
    @include('frontend.includes.head')
</head>

<body>
    <div class="position-relative" style="z-index: 99 !important">
        @php
            $no_wa = getSettings()->whatsapp;
            if ($no_wa[0] == 0) {
                $wa = explode('0', $no_wa);
                $new_wa = [];
                foreach ($wa as $key => $value) {
                    if ($key == 0) {
                        continue;
                    } else {
                        $new_wa[] = $value;
                    }
                }
                $wa = '62' . implode('', $new_wa);
            } else {
                $wa = $no_wa;
            }
        @endphp
        <a target="_blank" href="https://wa.me/{{ $wa }}" title="hubungi admin ({{ getSettings()->whatsapp }})"
            style="right: 20px !important; bottom: 100px !important;"
            class="position-fixed {{ getSettings()->whatsapp == '' ? 'd-none' : '' }} ">
            <img src="{{ asset('app-assets/icon/whatsapp.png') }}" alt="" width="60px">
        </a>
    </div>
    <nav class="navbar fixed-bottom bg-light px-0 mx-0">
        <div class="row w-100 px-0 mx-auto">
            <div class="col-5 d-flex">
                <div class="my-auto d-flex w-100">
                    <a href="{{ route('web.checkout') }}" class="position-relative me-3 my-auto">
                        <i class="me-2 text-danger" data-feather="shopping-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                            id="total_product">
                            0
                        </span>
                    </a>
                    <div class="my-auto">
                        <p class="m-0 p-0 w-100" style="font-size: 10px !important">Total Belanja</p>
                        <p class="fw-bold m-0 p-0" id="nominal_product" style="font-size: 13px !important">Rp. 0</p>
                    </div>
                </div>
            </div>
            <div class="col-2 d-flex">
                <a href="/" class="btn btn-danger mx-auto p-3 full-round d-block d-md-none"
                    title="kembali ke beranda">
                    <i class="" data-feather="home"></i>
                </a>
            </div>
            <div class="col-5 d-flex px-2">
                @yield('nav_bottom_btn')
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg fixed-top bg-danger">
        <div class="container" style="flex-wrap: initial !important">
            <a href="/" class="">
                @if (getSettings()->logo == '')
                    <img class="brand-logo me-4" style="padding: 0px !important"
                        src="{{ asset('app-assets/icon/store.png') }}" alt="">
                @else
                    <img class="brand-logo me-4" style="padding: 0px !important"
                        src="{{ route('storage.settingLogo', ['filename' => getSettings()->logo]) }}" alt="">
                @endif
            </a>
            <form action="" class="w-100">
                <input class="form-control my-auto input-search" type="search" name="product"
                    placeholder="Yuk! cari kebutuhanmu disini"
                    value="{{ isset($_GET['product']) ? $_GET['product'] : '' }}" aria-label="Search">
            </form>
    </nav>
    <div id="spinner" style="z-index: 99999 !important">
        <div class="d-flex h-100 w-100">
            <div class="loading-parrent m-auto">
                <div class="loading-object">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex">
        <div class="content h-100-vh py-1 py-md-4 mx-auto">
            @yield('content')
        </div>
    </div>
    <footer class="bg-dark pt-5 px-5 text-center text-white">
        <small>
            <b>Tentang Toko : </b><br>
            {{ getSettings()->description }}<br><br>

            <b>Alamat Toko : </b><br>
            {{ getSettings()->address }}<br><br>

            <b>Jam Layanan </b><br>
            {{ getSettings()->service_time }}<br><br>

            @if (getSettings()->instagram != '' &&
                getSettings()->facebook != '' &&
                getSettings()->email != '' &&
                getSettings()->phone != '')
                <b>Sosial Media </b><br>
                <div class="mt-2">
                    <center>
                        <a target="_blank" href="{{ getSettings()->instagram }}"
                            class="me-2 text-danger {{ getSettings()->instagram == '' ? 'd-none' : '' }} "> <i
                                data-feather="instagram"></i>
                        </a>
                        <a target="_blank" href="{{ getSettings()->facebook }}"
                            class="me-2 text-danger {{ getSettings()->facebook == '' ? 'd-none' : '' }} "> <i
                                data-feather="facebook"></i>
                        </a>
                        <a target="_blank" href="mailto:{{ getSettings()->email }}"
                            class="me-2 text-danger {{ getSettings()->email == '' ? 'd-none' : '' }} "> <i
                                data-feather="mail"></i>
                        </a>
                        <a target="_blank" href="{{ getSettings()->phone }}"
                            class="me-2 text-danger {{ getSettings()->phone == '' ? 'd-none' : '' }} "> <i
                                data-feather="phone-call"></i>
                        </a>
                    </center>
                </div>
            @endif
        </small>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </footer>
    @include('frontend.includes.script')
    @if ($message = Session::get('error'))
        <script>
            $.notify({
                message: "{{ $message }}",
            }, {
                type: 'warning',
                allow_dismiss: false,
                newest_on_top: true,
                mouse_over: true,
                showProgressbar: false,
                spacing: 10,
                timer: 2000,
                placement: {
                    from: 'top',
                    align: 'center'
                },
                offset: {
                    x: 30,
                    y: 120
                },
                delay: 1000,
                z_index: 10000,
                animate: {
                    enter: 'animated flash',
                    exit: 'animated swing'
                }
            });
        </script>
    @endif
</body>

</html>
