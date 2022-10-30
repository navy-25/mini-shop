<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Nama toko/website anda</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        <link href="{{ asset('app-assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <script src="https://unpkg.com/feather-icons"></script>

        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900" rel="stylesheet">

        @include('backend.includes.css')
        <style>
            .card {
                max-width: 30% !important;
                box-shadow: 0 0 50px 1rem rgb(86 27 51 / 10%);
            }
            @media only screen and (max-width: 600px) {
                .card{
                    max-width: 90% !important;
                }
            }
        </style>
    </head>
    <body>
        <div class="d-flex" style="height: 100vh">
            <div class="card m-auto">
                <img class="mx-auto py-2 pt-4" style="max-width: 50px !important"
                src="{{ asset('app-assets/icon/store.png') }}" alt="{{ asset('app-assets/icon/store.png') }}">
                <center>
                    <h6 class="p-0 m-0 fw-bold">Nama toko</h6>
                </center>
                <div class="card-body pt-4">
                    <form method="POST" class="row" action="{{ route('login.store') }}">
                        @csrf
                        <div class="col-12 mb-3">
                            <label for="email" class="form-label text-cen">
                                Alamat email<span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control" name="email"
                            placeholder="alamat email"
                            value="{{ old('email') }}" autofocus>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="password" class="form-label">
                                Kata sandi<span class="text-danger">*</span>
                            </label>
                            <input type="password" class="form-control"
                            placeholder="*********"
                            name="password">
                        </div>
                        <div class="col-12 mb-3">
                            <button type="submit" class="btn btn-danger w-100">Masuk</button>
                        </div>
                        <div class="col-12 text-center">
                            <small style="font-size: 8px !important">Copyright 2022 Nama toko</small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @include('backend.includes.script')
        @include('backend.includes.notify')
    </body>
</html>


