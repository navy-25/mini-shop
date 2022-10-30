<style>
    html,p,h1,h2,h3,h4,h5,h6,small,span,body{
        font-family: 'Poppins', sans-serif !important;
    }

    table tbody tr td, table thead tr th, table{
        font-size: 12px !important;
        padding: 5px !important;
        font-weight: normal !important;
    }


    /* select */
    .select2-container .select2-selection--single {
        border-radius: 4px !important;
        height: 47px !important;
        font-size: 12px;
        padding: 10px;
        padding-left: 5px !important;
        border-color: #efefef;
    }

    .select2 {
        width: 100% !important;
    }
    .select2-container--default .select2-results__option--selected {
        background-color: #dc3545 !important;
        color: white;
    }
    .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
        background-color: #dc3545;
        color: white;
    }
    .select2-container .select2-selection--multiple {
        border-radius: 4px !important;
        min-height: 47px !important;
        font-size: 12px !important;
        padding: 8px;
        padding-left: 5px !important;
        border-color: #efefef;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        padding: 0px 20px !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        margin-left: 0rem !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover, .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:focus {
        background-color: #0000003a;
        color: rgb(255, 255, 255);
        outline: none;
    }

    .form-control.is-valid:focus,
    .was-validated .form-control:valid:focus {
        border-color: #198754;
        -webkit-box-shadow: 0 0 0 .25rem rgba(25, 135, 84, .25);
        box-shadow: 0 0 0 .25rem rgba(25, 135, 84, .25)
    }
    /* end select */

    /* sweet alert */
    .swal2-popup {
        padding: 30px 0px 30px 0px !important;
        border-radius: 35px !important;
        max-width: 300px !important;
    }
    .swal2-styled.swal2-confirm, .swal2-styled.swal2-cancel {
        border-radius: 15px !important;
    }
    .swal2-title{
        font-size:20px !important;
    }
    .swal2-styled.swal2-default-outline:focus {
        box-shadow: none !important;
    }

    .swal2-styled.swal2-confirm:focus {
        box-shadow: none !important;
    }
    .swal2-styled.swal2-cancel:focus {
        box-shadow: none !important;
    }
    /* end sweet alert */

    .active>.page-link, .page-link.active {
        z-index: 3;
        color: white !important;
        background-color: #dc3545 !important;
        border-color:transparent;
    }
    .page-link:focus {
        box-shadow: inset -1px 0 0 rgb(0 0 0 / 0%) !important;
    }
    .page-link , #data-table_info{
        font-size: 10px !important;
        color: #212529 !important;
    }
    .sidebar .nav-link.active,.sidebar .nav-link.active:hover  {
        color: white;
        background: #dc3545;
        margin: 10px !important;
        border-radius: 5px !important;
    }
    .sidebar .nav-link:hover {
        color: white;
        background: #383838;
    }
    .navbar-brand {
        color: white !important;
        background-color: rgb(220 53 69);
        box-shadow: inset -1px 0 0 rgb(0 0 0 / 0%);
    }
    .navbar-toggler {
        top: 8px !important;
        color: white !important;
        border: 0px solid rgba(255, 255, 255, 0);
    }
    .navbar-toggler:focus {
        text-decoration: none;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgb(13 110 253 / 0%);
    }
    .form-control:focus {
        color: #212529;
        background-color: #fff;
        outline: 0;
        border-color: #e56975 !important;
        box-shadow: 0 0 0 0.25rem rgb(13 110 253 / 0%);
    }
    .form-label{
        font-size:12px !important;
    }
    @media only screen and (max-width: 600px) {
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
