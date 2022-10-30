@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-header py-3 px-3">
        <div class="row">
            <div class="col-12 d-flex">
                <p class="my-auto">Pengaturan {{ $page['title'] }}</p>
            </div>
        </div>
    </div>
    <div class="card-body py-4 px-3">
        <form id="form" class="row" action="{{ route('admin.account.update',['id' => $data->id]) }}" method="POST">
            @csrf
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="email" class="form-label required">Alamat email</label>
                    <input type="text" value="{{ $data->email }}" name="email" id="email" class="form-control" placeholder="alamat email">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="password" class="form-label optional">Kata sandi</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="**********">
                    <small class="text-danger"><i>*isi jika ingin merubah kata sandi</i></small>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-sm btn-danger">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
