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

    <table class="table table-bordered">
        <thead>
            <th>id</th>
            <th>total</th>
            <th>products</th>
            <th>status</th>
            <th>delete</th>
        </thead>
        <tbody>
            @if($orders)
            @foreach($orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->total}}</td>
                <td>
                    <?php
                    $products = App\Models\Orderdetail::where('order_id', $order->id)->get();
                    ?>
                    @foreach($products as $product)
                    {{$product->product_id}}
                    @endforeach

                </td>
                <td>
                    <form enctype="multipart/form-data" action="">
                        @csrf
                        <input type="hidden" value="{{$order->id}}" id="order_id" name="order_id" class="order_id">
                        <select name="status" id="status">
                            <option data-display="{{$order->status}}">{{$order->status}}</option>
                            <option value="pending">pending</option>
                            <option value="processing">processing</option>
                            <option value="complete">complete</option>
                        </select>
                        <button type="button" class="btn btn-success button-status">Submit</button>
                    </form>
                </td>

                <td>
                    <form action="{{route('deleteOrder')}}" method="post">
                        @csrf
                        <input type="hidden" value="{{$order->id}}" name="order_id">
                        <button type="submit" class="btn btn-danger btn-delete-product">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
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
                                $(".button-status").click(function(e){
e.preventDefault();

var $button = $(this);
var status = $button.parent().find("select").val();
var order_id = $button.parent().find("input.order_id").val();
console.log(status,order_id);
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$.ajax({
            type:'POST',
            url:"{{ route('orderStatus') }}",
            data:{order_id:order_id, status:status},
            success:function(data){
                
                toastr.success(data.success);
            }
        });


});
</script>

</body>


</html>