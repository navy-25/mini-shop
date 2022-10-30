<!doctype html>
<html lang="en">
    <head>
        @include('backend.includes.head')
        @include('backend.includes.css')
    </head>
    <body>
        @include('backend.includes.navbar')
        <div class="container-fluid">
            <div class="row">
                @include('backend.includes.sidebar')
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    @yield('content')
                </main>
            </div>
        </div>
        @include('backend.includes.script')
    </body>
</html>
