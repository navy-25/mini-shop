<style>
    html,p,h1,h2,h3,h4,h5,h6,small,span,body{
        font-family: 'Poppins', sans-serif !important;
    }
    .form-control:focus {
        color: #212529;
        background-color: #fff;
        outline: 0;
        border-color: #e56975 !important;
        box-shadow: 0 0 0 0.25rem rgb(13 110 253 / 0%);
    }
    .card {
        max-width: 30% !important;
        box-shadow: 0 0 50px 1rem rgb(86 27 51 / 10%);
    }
    .form-label{
        font-size:12px !important;
    }
    @media only screen and (max-width: 600px) {
        .card{
            max-width: 90% !important;
        }
        .alert {
            left: 20px !important;
            right: 20px !important;
        }
    }
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
    }

    .bi {
        vertical-align: -.125em;
        fill: currentColor;
    }

    .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
    }

    .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
    }
</style>
