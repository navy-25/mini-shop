{{-- META --}}
<title>@yield('title') - {{ getSettings()->name }}</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description"
    content="{{ getSettings()->description }}, {{ getSettings()->service_time }}, {{ getSettings()->address }}">
<meta name="keywords" content="{{ getSettings()->keywords }}">
<meta name="author" content="{{ getSettings()->name }}">
{{-- open graph --}}
<meta property="og:site_name" content="{{ getSettings()->name }} online shop" />
<meta property=“og:title” content="@yield('title') - {{ getSettings()->name }}" />
<meta property="og:description"
    content="{{ getSettings()->description }}, {{ getSettings()->service_time }}, {{ getSettings()->address }}" />
<meta property="og:url" content="{{ request()->getHttpHost() }}" />
<meta property="og:type" content="product" />
<meta property="og:type" content="website" />
<meta property="article:publisher" content="{{ request()->getHttpHost() }}" />
<meta property="article:section" content="{{ getSettings()->name }}" />
<meta property="article:tag" content="{{ getSettings()->keywords }}" />
<meta property="twitter:site" content="{{ getSettings()->name }} online shop" />
{{-- END META --}}

<link rel="icon" type="image/x-icon"
    href="{{ getSettings()->logo == '' ? asset('app-assets/icon/store.png') : route('storage.settingLogo', ['filename' => getSettings()->logo]) }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/poppins.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/slick.css') }}" />
<link href="{{ asset('app-assets/css/bootstrap.min.css') }}" rel="stylesheet">

<script type="text/javascript" src="{{ asset('app-assets/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/bootstrap2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('app-assets/js/feather.min.js') }}"></script>
@include('frontend.includes.css')
