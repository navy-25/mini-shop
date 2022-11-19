@extends('layouts.web')
@section('title')
    Daftar Belanjaan
@endsection
@section('nav_bottom_btn')
    <button type="button" onclick="$('#btn_submit').trigger('click')"
        class="my-auto ms-auto btn btn-success d-flex full-round px-4">
        <small>Pesan</small>
    </button>
@endsection
@section('content')
    <div class="container px-0">
        <form action="{{ route('web.checkout.store') }}" method="POST">
            @csrf
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex">
                        <a href="/" class="btn btn-light my-auto me-3 d-none d-md-block">
                            < </a>
                                <h6 class="p-0 m-0 my-auto">
                                    Daftar belanjaan kamu
                                </h6>
                    </div>
                    <div class="row m-0" id="cart_list"></div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="p-0 m-0">
                        Lengkapi identitas
                    </h6>
                    <hr>
                    <div class="form-group mb-3">
                        <label for="" class="mb-1">Nama Lengkap<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value=""
                            placeholder="nama lengkap anda" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="mb-1">Whatsapp<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone" value="" placeholder="0821xxxxxxxx"
                            required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="mb-1">Alamat lengkap<span class="text-danger">*</span></label>
                        <textarea name="address" id="" class="form-control" cols="30" rows="3" required
                            placeholder="Ds. xxx, Kec. xxx, RT.00, RW.00, No. xx - (Patokan rumah)"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="mb-1">Catatan<span>(optional)</span></label>
                        <textarea name="noted" id="" class="form-control" cols="30" rows="3"
                            placeholder="ex. Kantong plastiknya di doble ya kak"></textarea>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="p-0 m-0">
                        Detail Pemesanan
                    </h6>
                    <hr>
                    <div class="row">
                        <div class="col-4">Qty. Barang</div>
                        <div class="col-8 fw-bold text-danger" id="detail_total_barang"></div>
                    </div>
                    <div class="row">
                        <div class="col-4">Total</div>
                        <div class="col-8 fw-bold text-danger" id="detail_total_keseluruhan"></div>
                    </div>
                </div>
            </div>
            <button type="submit" class="d-none d-md-block mb-3 btn btn-success w-100" id="btn_submit">Pesan
                sekarang</button>
        </form>
    </div>
@endsection
