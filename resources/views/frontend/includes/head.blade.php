<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ getSettings()->name }}</title>

<link rel="icon" type="image/x-icon"
    href="{{ getSettings()->logo == '' ? asset('app-assets/icon/store.png') : route('storage.settingLogo', ['filename' => getSettings()->logo]) }}">

<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/poppins.css') }}" />

<script type="text/javascript" src="{{ asset('app-assets/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/feather.min.js') }}"></script>

<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/slick.css') }}" />
<link href="{{ asset('app-assets/css/bootstrap.min.css') }}" rel="stylesheet">

@include('frontend.includes.css')
