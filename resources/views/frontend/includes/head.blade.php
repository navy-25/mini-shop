<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ getSettings()->name }}</title>

<link rel="icon" type="image/x-icon" href="{{ getSettings()->logo == '' ? asset('app-assets/icon/store.png') : route('storage.settingLogo',['filename'=>getSettings()->logo]) }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900" rel="stylesheet">

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>

<link href="{{ asset('app-assets/css/bootstrap.min.css') }}" rel="stylesheet">

@include('frontend.includes.css')
