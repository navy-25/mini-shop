<style>
    html,
    p,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    small,
    span,
    body {
        font-family: 'Poppins', sans-serif !important;
    }

    .navbar {
        box-shadow: 0 0 10px 1rem #6f1a222b !important;
    }

    .brand-logo {
        width: 50px !important;
        height: 50px !important;
    }

    .form-control:focus {
        color: #212529;
        background-color: #fff;
        border-color: #e56975 !important;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgb(13 110 253 / 0%);
    }

    .input-search {
        height: 40px !important;
        border-radius: 100px !important;
        padding: 10px 20px !important;
    }

    .full-round {
        border-radius: 100px !important;
    }

    .round-sm {
        border-radius: 10px !important;
    }

    .h-100-vh {
        min-height: 100vh;
    }

    .w-100-vw {
        width: 100vh;
    }

    .content {
        margin-top: 15vh !important;
        min-height: 85vh !important;
        width: 70% !important;
    }

    .image-banner {
        aspect-ratio: 9/3 !important;
    }

    .border-none {
        border: none !important;
    }

    .product-image {
        aspect-ratio: 4/3 !important;
        border-radius: 10px !important;
    }

    .carousel-control-next-icon {
        width: 25px !important;
        height: 25px !important;
        background-position: center !important;
        background-size: 8px !important;
    }

    .carousel-control-prev-icon {
        width: 25px !important;
        height: 25px !important;
        background-position: center !important;
        background-size: 8px !important;
    }

    #dropdown-nav {
        position: fixed !important;
        top: 0vh !important;
        padding-top: 15vh !important;
        left: 0px !important;
        width: 100% !important;
        z-index: 10 !important;
    }

    .bg-dropdown {
        background: #bd2635e6 !important;
    }

    hr {
        margin: 1rem 0;
        color: inherit;
        border: 0;
        border-top: 0.5px solid;
        opacity: .15;
    }

    @media only screen and (max-width: 600px) {
        .text-category {
            font-size: 15px !important;
        }

        .content {
            margin-top: 12vh !important;
            min-height: 88vh !important;
            width: 90% !important;
        }

        .brand-logo {
            padding-top: 5px !important;
            padding-bottom: 5px !important;
            /* width: 45px !important; */
            height: 50px !important;
        }

        #dropdown-nav {
            position: fixed !important;
            padding-top: 10vh !important;
            top: 0vh !important;
            left: 0px !important;
            width: 100% !important;
            z-index: 10 !important;
        }

        /* NOTIFY */
        .notify-alert {
            margin-left: 15px !important;
            margin-right: 15px !important;
        }

        /* END NOTIFY */
    }

    /* SPINNER */
    #spinner {
        position: fixed !important;
        z-index: 100 !important;
        height: 100vh !important;
        width: 100% !important;
        background: rgb(255, 255, 255);
        top: 0px !important;
    }

    @keyframes loading-object {
        0% {
            transform: translate(12.84px, 85.60000000000001px) scale(0);
        }

        25% {
            transform: translate(12.84px, 85.60000000000001px) scale(0);
        }

        50% {
            transform: translate(12.84px, 85.60000000000001px) scale(1);
        }

        75% {
            transform: translate(85.60000000000001px, 85.60000000000001px) scale(1);
        }

        100% {
            transform: translate(158.36px, 85.60000000000001px) scale(1);
        }
    }

    @keyframes loading-object-r {
        0% {
            transform: translate(158.36px, 85.60000000000001px) scale(1):
        }

        100% {
            transform: translate(158.36px, 85.60000000000001px) scale(0);
        }
    }

    @keyframes loading-object-c {
        0% {
            background: #3c0f0f
        }

        25% {
            background: #edb195
        }

        50% {
            background: #e46b43
        }

        75% {
            background: #f91a10
        }

        100% {
            background: #3c0f0f
        }
    }

    .loading-object div {
        position: absolute;
        width: 42.800000000000004px;
        height: 42.800000000000004px;
        border-radius: 50%;
        transform: translate(85.60000000000001px, 85.60000000000001px) scale(1);
        background: #3c0f0f;
        animation: loading-object 2.2222222222222223s infinite cubic-bezier(0, 0.5, 0.5, 1);
    }

    .loading-object div:nth-child(1) {
        background: #f91a10;
        transform: translate(158.36px, 85.60000000000001px) scale(1);
        animation: loading-object-r 0.5555555555555556s infinite cubic-bezier(0, 0.5, 0.5, 1), loading-object-c 2.2222222222222223s infinite step-start;
    }

    .loading-object div:nth-child(2) {
        animation-delay: -0.5555555555555556s;
        background: #3c0f0f;
    }

    .loading-object div:nth-child(3) {
        animation-delay: -1.1111111111111112s;
        background: #f91a10;
    }

    .loading-object div:nth-child(4) {
        animation-delay: -1.6666666666666665s;
        background: #e46b43;
    }

    .loading-object div:nth-child(5) {
        animation-delay: -2.2222222222222223s;
        background: #edb195;
    }

    .loading-parrent {
        width: 214px;
        height: 214px;
        display: inline-block;
        overflow: hidden;
        background: rgba(NaN, NaN, NaN, 0);
    }

    .loading-object {
        width: 100%;
        height: 100%;
        position: relative;
        transform: translateZ(0) scale(1);
        backface-visibility: hidden;
        transform-origin: 0 0;
    }

    .loading-object div {
        box-sizing: content-box;
    }

    /* END SPINNER */
</style>
