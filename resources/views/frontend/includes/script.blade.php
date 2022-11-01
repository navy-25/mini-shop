<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<script src="{{ asset('app-assets/js/bootstrap.bundle.min.js') }}"></script>
<script>
    feather.replace()
    $(document).ready(function () {
        $('#spinner').fadeOut();
    });

    var carts = {}
    var total_price = 0;
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
    function min(id_input,id_price){
        var value = $(id_input).val()
        var price = $(id_price).val()

        if(value > 0){
            var temp_value = parseInt(value) - 1
            total_price -= parseInt(price)
            console.log(price)


            $(id_input).val(temp_value)
            cart([id_input,temp_value,price])
        }
    }
    function plus(id_input,id_price){
        var value = $(id_input).val()
        var price = $(id_price).val()

        var temp_value = parseInt(value) + 1
        total_price += parseInt(price)
        console.log(price)


        $(id_input).val(temp_value)
        cart([id_input,temp_value,price])
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
        console.log(total_price)
        $('#total_product').text(total_product)
        $('#nominal_product').text('Rp. '+numberFormat(total_price))
    }
    function numberFormat(number){
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }
    function viewMore(){
        var index_temp = $('#total_product_list').val()
        var index_now = parseInt(index_temp)+parseInt('{{ $data['total_show'] }}')
        $('#total_product_list').val(index_now)

        if('{{ isset($_GET['category']) }}'){
            var category_name = $('#category_name').val()
        }else{
            var category_name = $('#category_name').val()
        }

        if('{{ isset($_GET['product']) }}'){
            var product = $('#product').val()
        }else{
            var product = ''
        }
        console.log(product)
        $.ajax({
            type: "get",
            url: '{{ route('web.more') }}',
            data: {start:index_temp,end:index_now,category_name:category_name,product:product},
            success: function(response) {
                console.log(response)
                Object.entries(response).forEach(([key, val]) => {
                    if(val.thumbnail == ''){
                        var srcThumbnail = "{{ asset('app-assets/image/default-4-3.png') }}"
                        var thumbnail = `<img class="w-100 product-image"
                                    src="`+srcThumbnail+`"
                                    alt="`+srcThumbnail+`">`
                    }else{
                        var srcThumbnail = "{{ route('storage.productThumbnail',['filename' => ':filename']) }}".replaceAll(':filename', val.thumbnail)
                        var thumbnail = `<img class="w-100 product-image"
                                    src="`+srcThumbnail+`"
                                    alt="`+val.thumbnail+`">`
                    }
                    $('#product_list').append(`
                        <div class="row m-0">
                            <div class="col-5 col-md-3 col-lg-2">`+thumbnail+`</div>
                            <div class="col-7 col-md-9 col-lg-10">
                                <h6 class="fw-bold my-0">`+val.name+`</h6>
                                <small class="text-danger fw-bold">Rp. `+numberFormat(val.price)+`</small>
                                <input type="hidden" id="product_price_`+key+`" value="`+val.price+`">
                                <div class="d-flex mt-3">
                                    <button onclick="min('#input_`+key+`','#product_price_`+key+`')" class="btn btn-secondary me-2 full-round ms-auto">-</button>
                                    <input type="text" id="input_`+key+`" class="form-control" value="0" style="width: 60px !important;text-align: center !important" readonly>
                                    <button onclick="plus('#input_`+key+`','#product_price_`+key+`')" class="btn btn-danger ms-2 full-round">+</button>
                                </div>
                            </div>
                        </div>
                        <hr>
                    `)
                })
                if(response.length < parseInt('{{ $data['total_show'] }}')){
                    $('#btn_more').addClass('d-none')
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(errorThrown)
            }
        });
        console.log(index_temp,index_now)
    }
</script>
