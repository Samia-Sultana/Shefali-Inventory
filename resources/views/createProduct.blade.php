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
    <form enctype="multipart/form-data" method="POST" action="{{ route('addProduct') }}" class="d-flex">
        @csrf
        <div class="d-flex flex-column">
        <input type="text" id="name" name="name" placeholder="name"></br></br>
        <input type="text" name="sku" id="sku" placeholder="SKU"></br></br>
        <input type="file" id="thumbnail" name="thumbnail" placeholder="thumb"></br></br>
        <textarea class="form-control" type="text" id="description" name="description"> </textarea></br></br>
        <input type="submit" value="Submit" class="btn btn-primary">
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <th>id</th>
            <th>name</th>
            <th>sku</th>
            <th>update</th>
            <th>delete</th>
        </thead>
        <tbody>
            @if($products)
            @foreach($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->sku}}</td>

                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="{{'#update_product_'.$product->id}}">
                        Update
                    </button>
                    <div class="modal fade" id="{{'update_product_' . $product->id}}" tabindex="-1" role="dialog" aria-labelledby="update_product_lebel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="update_product_lebel">Update product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{route('updateProduct')}}" enctype="multipart/form-data" class="d-flex">
                                        @csrf
                                        <div class="p-1">
                                            <input type="hidden" id="update_productId" name="update_productId" value="{{$product->id}}">
                                            <input type="text" id="update_name" name="update_name" value="{{$product->name}}"><br><br>
                                            <input type="text" id="update_sku" name="update_sku" value="{{$product->sku}}"><br><br>
                                            <input type="file" id="update_thumbnail" name="update_thumbnail"><br><br>
                                            <textarea class="form-control" type="text" id="update_description" name="update_description">{{$product->description}} </textarea></br></br>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary btn-update-product">Save changes</button>
                                        </div>

                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Modal -->

                </td>

                <td>
                    <form action="{{route('deleteProduct')}}" method="post">
                        @csrf
                        <input type="hidden" value="{{$product->id}}" name="product_id">
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

</body>


</html>