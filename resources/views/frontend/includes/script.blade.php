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
        var index_now = parseInt(index_temp)+5
        $('#total_product_list').val(index_now)
        console.log(index_temp,index_now)
    }
</script>
