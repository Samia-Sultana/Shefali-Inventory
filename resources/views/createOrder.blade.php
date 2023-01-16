<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- bootstrap cdn for toastr -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="productSlider-style2 grid-products">

                    @foreach($allProduct as $item)
                    <div class="col-12 item">
                        <!-- start product image -->
                        <div class="product-image col-4" style="border:2px solid red;">
                            <!-- start product image -->

                            <!-- image -->
                            <?php
                            $productDetail = App\Models\Product::find($item->product_id);
                            ?>
                            <img src="{{url('photos/'.$productDetail->thumbnail)}}" alt="image" title="product" style="height: 220px;width:220px;">
                            <!-- End image -->
                            </a>
                            <!-- end product image -->
                            <!-- Start product button -->
                            <div class="variants add">
                                <form action="{{route('addToCart')}}" method="POST">
                                    @csrf
                                    <span>Code:{{$item->barcode}}</span>
                                    <input type="hidden" class="pro-id" value="{{$item->barcode}}" name="barcode" />
                                    <button class="btn btn-primary btn-addto-cart cart-btn-alert btn-submit" type="submit" tabindex="0">Add</button>
                                </form>
                            </div>
                            <!-- end product button -->
                        </div>
                        <!-- end product image -->

                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    <!--Body Content-->
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div id="page-content">
                    <!--Page Title-->
                    <div class="page section-header text-center">
                        <div class="page-title">
                            <div class="wrapper">
                                <h1 class="page-width">Your cart</h1>
                            </div>
                        </div>
                    </div>
                    <!--End Page Title-->

                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-8 col-lg-8 main-col cart-detail-row">
                                <form action="#" method="post" class="cart style2">
                                    <table class="table table-bordered">
                                        <thead class="cart__row cart__header">
                                            <tr class="text-center">
                                                <th class="text-center">Price</th>

                                                <th class="text-center">Quantity</th>

                                                <th class="text-right">Total</th>
                                                <th class="action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="CartBody">
                                            @if(Session::get('cart'))
                                            @foreach( Session::get('cart') as $product)
                                            <tr style="text-align: center;">
                                                <td>{{$product->price}}</td>
                                                <td class="pro-quantity">
                                                    <form action="#" class="display-flex">
                                                        <input type="hidden" value="{{$product->barcode}}" id="barcode">
                                                        <div class="d-flex flex-row justify-content-between">
                                                            <button class="button-qty inc" type="button">
                                                                inc</button>
                                                            <input type="text" value="{{$product->qty}}" readonly id="prod-qty">
                                                            <input type="hidden" value="{{$product->barcode}}" id="barcode">

                                                            <button class="button-qty dec" type="button">
                                                                dec
                                                            </button>
                                                        </div>
                                                    </form>
                                                </td>

                                                <td>{{$product->price * $product->qty}}</td>
                                                <td>
                                                    <form action="{{route('removeCartProduct')}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="barcode" value="{{$product->barcode}}">
                                                        <button type="submit" class="remove">remove</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>

                                    </table>


                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 cart__footer">

                                <div class="solid-border">

                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="{{'#update_product_'}}">
                                        Place order
                                    </button>
                                    <div class="modal fade" id="{{'update_product_'}}" tabindex="-1" role="dialog" aria-labelledby="update_product_lebel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="update_product_lebel">Billing info</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{route('checkout')}}" class="d-flex" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="p-1">
                                                            <fieldset>
                                                                <h2 class="login-title mb-3">Billing details</h2>
                                                               
                                                                <div class="row">
                                                                    
                                                                    <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                                                        <label for="phone">Telephone <span class="required-f">*</span></label>
                                                                        <input name="phone" value="" id="phone" type="text" required>
                                                                    </div>
                                                                </div>
                                                            </fieldset>


                                                            <fieldset>
                                                                <div class="row">
                                                                    
                                                                    <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                                                        <label for="address">Address </label>
                                                                        <input name="address" value="" id="address" type="text" required>
                                                                    </div>
                                                                </div>

                                                            </fieldset>
                                                            <fieldset>
                                                                <div class="row">
                                                                    <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                                                        <label for="city">Choose City </label>

                                                                        <select name="city" id="city" required>
                                                                            <option value="">Choose..</option>
                                                                            <option>Dhaka</option>
                                                                            <option>Rajshahi</option>
                                                                            <option>Barishal</option>
                                                                            <option>Sylhet</option>
                                                                            <option>Kushtia</option>
                                                                            <option>Chittagong</option>
                                                                        </select>
                                                                    </div>

                                                                    
                                                                </div>
                                                            </fieldset>


                                                            <fieldset>
                                                                <div class="row">
                                                                    <div class="form-group col-md-12 col-lg-12 col-xl-12 required">
                                                                        <label for="message">Order Notes <span class="required-f">*</span></label>
                                                                        <textarea class="form-control resize-both" id="message" name="message" rows="3" required></textarea>
                                                                    </div>
                                                                </div>
                                                            </fieldset>

                                                        </div>
                                                        <div class="modal-footer">
                                                    <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary btn-update-product">Submit</button>
                                                </div>

                                                    </form>

                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal -->
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--End Body Content-->


    <!-------modal cdn -------------->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-------modal cdn end-------------->
    <!-------toaster cdn -------------->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"> </script>
    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch (type) {
            case 'info':
                toastr.info(" {{ Session::get('message') }} ");
                break;
            case 'success':
                toastr.success(" {{ Session::get('message') }} ");
                break;
            case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;
            case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break;
        }
        @endif
    </script>
    <!-------end toaster cdn -------------->


    <script type="text/Javascript">

        $(".button-qty").click(function(e){
e.preventDefault();

var $button = $(this);
var oldQuantity = $button.parent().find("input:even").val();
var productBarcode = $button.parent().find("input:odd").val();

console.log(oldQuantity,productBarcode);
var newQuantity;
$button.blur();
if ($button.hasClass("inc")) {
    newQuantity = parseFloat(oldQuantity) + 1;
} 
else {
if (oldQuantity > 1) {
    newQuantity = parseFloat(oldQuantity) - 1;
} else {
    newQuantity = 1;
}
}


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$.ajax({
    type:'POST',
    url:"{{ route('updateShoppingCart') }}",
    data:{barcode:productBarcode, newQuantity:newQuantity},
    success:function(data){
        var productPrice = $button.parents(".pro-quantity").prev().text();
        $button.parent().find("input:even").val(newQuantity);
        $button.parents(".pro-quantity").next().text(newQuantity * productPrice);

        var cart = JSON.parse(data.cart);
        console.log(cart);
        var subTotal = cart.reduce(function(accumulator,currentItem){
            return accumulator + (currentItem.qty * currentItem.price);
        },0);
        var grandTotal = subTotal ;
        //console.log(grandTotal);
        $button.parents(".cart-detail-row").next().find("span.money").text(subTotal);
        //$button.parents(".cart-detail-row").next().find("td.grand-total").text(grandTotal);
        
    }
});


});
</script>



</body>


</html>