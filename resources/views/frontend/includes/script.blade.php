<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<script src="{{ asset('app-assets/js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="{{ asset('app-assets/js/bootstrap-notify.min.js') }}" ></script>
<script src="{{ asset('app-assets/js/notify-script.js') }}" ></script>
@yield('script')
<script>
    feather.replace()
    $(document).ready(function () {
        $('#spinner').fadeOut();
        $('.slicker').slick({
            centerMode: true,
            centerPadding: '60px',
            slidesToShow: 2,
            arrows: false,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 1
                    }
                }
            ]
        });
        refresh()
    });

    // localStorage.getItem(key);
    var carts = {}
    var total_price = 0;

    function refresh(){
        Object.entries(localStorage).forEach(([key, value]) => {
            var data_card = JSON.parse(value)
            $(data_card.id_input).val(data_card.quantity)
            cart([data_card.id_input,data_card.quantity,data_card.price])
            total_price += data_card.quantity*data_card.price

            if(data_card.image == ''){
                var thumbnail = "{{ asset('app-assets/image/web-default-4-3.png') }}"
            }else{
                var thumbnail = "{{ route('storage.productThumbnail',['filename'=>':filename']) }}".replace(':filename',data_card.image)
            }

            $('#cart_list').append(`
                <div class="col-12 px-0">
                    <hr>
                    <div class="row m-0" id="colom_`+data_card.id_input.replace('#','')+`">
                        <div class="col-4 col-md-3 col-lg-2 px-0">
                            <img class="w-100 product-image"
                                src="`+thumbnail+`"
                                alt="thumbnail produk">
                        </div>
                        <div class="col-8 col-md-9 col-lg-10 px-0">
                            <div class="px-2">
                                <h6 class="fw-bold my-0">`+data_card.name+`</h6>
                                <small class="text-danger fw-bold">Rp`+numberFormat(data_card.price)+`</small>
                                <input type="hidden" id="`+data_card.id_price.replace('#','')+`" value="`+data_card.price+`">

                                <input type="hidden" name="id_product[]" value="`+key+`">
                                <input type="hidden" name="quantity[]" value="`+data_card.quantity+`">
                            </div>
                            <div class="d-flex mt-1 px-0 w-100">
                                    <button class="btn btn-secondary me-auto m-2 my-auto bg-secondary p-0 rounded text-white" type="button" onclick="delete_product('colom_`+data_card.id_input.replace('#','')+`','`+key+`')"
                                    style="width: 30px !important;height: 30px !important">
                                    <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 m-0 p-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                </button>

                                <button
                                    type="button"
                                    onclick="min('`+data_card.id_input+`','`+data_card.id_price+`',`+key+`,'`+data_card.name+`','`+data_card.thumbnail+`')"
                                    style="width: 40px !important;height: 40px !important"
                                    class="btn btn-secondary me-2 full-round ms-auto">
                                    -
                                </button>

                                <input
                                    type="text" id="`+data_card.id_input.replace('#','')+`"
                                    class="form-control" value="`+data_card.quantity+`"
                                    style="width: 60px !important;height: 40px !important;text-align: center !important" readonly>

                                <button
                                    type="button"
                                    onclick="plus('`+data_card.id_input+`','`+data_card.id_price+`',`+key+`,'`+data_card.name+`','`+data_card.thumbnail+`')"
                                    style="width: 40px !important;height: 40px !important"
                                    class="btn btn-danger ms-2 full-round">+</button>
                            </div>
                        </div>
                    </div>
                </div>
            `)
        })
        $('#nominal_product').text('Rp'+numberFormat(total_price))
        $('#detail_total_keseluruhan').text(': Rp'+numberFormat(total_price))
    }

    function delete_product(id_colum,id_product){
        document.getElementById(id_colum).remove();
        localStorage.removeItem(id_product);
        $('#cart_list').html('')
        total_price = 0;
        refresh()
    }

    function showMenu(){
        var isNone = $('#dropdown-nav').attr('class').search(/d-none/i);
        if(isNone > 1){
            $('#dropdown-nav').removeClass('d-none')
            $('#close').removeClass('d-none')
            $('#menu').addClass('d-none')

        }else{
            $('#dropdown-nav').addClass('d-none')
            $('#close').addClass('d-none')
            $('#menu').removeClass('d-none')
        }
    }
    function min(id_input,id_price,id_product,product_name,image){
        var value = $(id_input).val()
        var price = $(id_price).val()

        if(value > 0){
            var temp_value = parseInt(value) - 1
            total_price -= parseInt(price)
            var cart_json = {
                'id_input' : id_input,
                'id_price' : id_price,
                'quantity' : temp_value,
                'price' : price,
                'total' : total_price,
                'name' : product_name,
                'image' : image,
            }
            $(id_input).val(temp_value)
            cart([id_input,temp_value,price])
            localStorage.setItem(id_product, JSON.stringify(cart_json));
            if(temp_value == 0){
                localStorage.removeItem(id_product)
                delete_product('colom_'+id_input.replace('#',''),id_product)
            }
        }
    }
    function plus(id_input,id_price,id_product,product_name,image){
        var value = $(id_input).val()
        var price = $(id_price).val()
        var temp_value = parseInt(value) + 1
        total_price += parseInt(price)
        var cart_json = {
            'id_input' : id_input,
            'id_price' : id_price,
            'quantity' : temp_value,
            'price' : price,
            'total' : total_price,
            'name' : product_name,
            'image' : image,
        }
        $(id_input).val(temp_value)
        cart([id_input,temp_value,price])
        localStorage.setItem(id_product, JSON.stringify(cart_json));
    }
    function cart(val_input = []){
        if(val_input[1] == 0){
            delete carts[val_input[0]]
        }else{
            if(carts[val_input] == undefined){
                carts[val_input[0]] = val_input[1]
            }else{
                carts[val_input[0]] = val_input[1]
            }
        }
        total_product = Object.keys(carts).length
        $('#total_product').text(numberFormat(total_product))
        $('#nominal_product').text('Rp'+numberFormat(total_price))
        $('#detail_total_barang').text(': '+numberFormat(total_product)+' Jenis')
        $('#detail_total_keseluruhan').text(': Rp'+numberFormat(total_price))
    }
    function numberFormat(number){
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }
</script>
