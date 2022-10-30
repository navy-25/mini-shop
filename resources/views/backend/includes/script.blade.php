<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="{{ asset('app-assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('app-assets/js/bootstrap-notify.min.js') }}" ></script>
<script src="{{ asset('app-assets/js/notify-script.js') }}" ></script>
<script src="{{ asset('app-assets/js/helper.js') }}" ></script>
<script src="{{ asset('app-assets/js/sweet-alert/sweetalert2@11.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@yield('custom_js')

<script>
    feather.replace()
    $(document).ready(function () {
        $('#spinner').fadeOut();
    });
</script>
