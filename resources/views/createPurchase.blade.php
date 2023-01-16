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
    <form enctype="multipart/form-data" method="POST" action="{{ route('addPurchase') }}" class="d-flex">
        @csrf
        <div class="d-flex flex-column">
            <select name="product" id="product">
                @if($products)
                @foreach($products as $product)
                <option value="{{$product->id}}">{{$product->name}}-{{$product->sku}}</option>
                @endforeach
                @endif

            </select>
            <select name="supplier" id="supplier">
                @if($suppliers)
                @foreach($suppliers as $supplier)
                <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                @endforeach
                @endif

            </select>
            <input type="text" id="buyingPrice" name="buyingPrice" placeholder="buying Price"></br></br>
            <input type="text" id="sellingPrice" name="sellingPrice" placeholder="selling Price"></br></br>
            <input type="date" id="purchaseDate" name="purchaseDate" placeholder="purchase Date"></br></br>
            <input type="date" id="expiryDate" name="expiryDate" placeholder="expiry Date"></br></br>
            <input type="text" id="batchNo" name="batchNo" placeholder="batch No"></br></br>
            <input type="text" id="wrackNo" name="wrackNo" placeholder="wrack No"></br></br>
            <input type="text" id="warehouse" name="warehouse" placeholder="ware House"></br></br>
            <input type="text" id="totalQty" name="totalQty" placeholder="total Qty"></br></br>
            <input type="submit" value="submit">
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <th>Purchase id</th>
            <th>update</th>
            <th>delete</th>
            <th> generate barcode</th>
        </thead>
        <tbody>
            @if($purchases)
            @foreach($purchases as $purchase)
            <tr>
                <td>{{$purchase->id}}</td>

                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="{{'#update_purchase_'.$purchase->id}}">
                        Update
                    </button>
                    <div class="modal fade" id="{{'update_purchase_' . $purchase->id}}" tabindex="-1" role="dialog" aria-labelledby="update_product_lebel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="update_purchase_lebel">Update purchase</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{route('updatePurchase')}}" class="d-flex">
                                        @csrf
                                        <div class="p-1">
                                            <select name="product" id="product">
                                                <?php
                                                $productDetail = App\Models\Product::find($purchase->product_id);
                                                ?>
                                                <option value="{{$purchase->product_id}}">{{$productDetail->name}}-{{$productDetail->sku}}</option>
                                                @if($products)
                                                @foreach($products as $product)
                                                <option value="{{$product->id}}">{{$product->name}}-{{$product->sku}}</option>
                                                @endforeach
                                                @endif

                                            </select>
                                            <select name="supplier" id="supplier">
                                                <?php
                                                $supplierDetail = App\Models\Supplier::find($purchase->supplier_id);
                                                ?>
                                                <option value="{{$purchase->supplier_id}}">{{$supplierDetail->name}}</option>
                                                @if($suppliers)
                                                @foreach($suppliers as $supplier)
                                                <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                                @endforeach
                                                @endif

                                            </select>
                                            <input type="hidden" id="purchaseId" name="purchaseId" value="{{$purchase->id}}"></br></br>
                                            <input type="text" id="buyingPrice" name="buyingPrice" value="{{$purchase->buying_price}}"></br></br>
                                            <input type="text" id="sellingPrice" name="sellingPrice" value="{{$purchase->selling_price}}"></br></br>
                                            <input type="date" id="purchaseDate" name="purchaseDate" value="{{$purchase->purchase_date}}"></br></br>
                                            <input type="date" id="expiryDate" name="expiryDate" value="{{$purchase->expiry_date}}"></br></br>
                                            <input type="text" id="batchNo" name="batchNo" value="{{$purchase->batch_no}}"></br></br>
                                            <input type="text" id="wrackNo" name="wrackNo" value="{{$purchase->wrack_no}}"></br></br>
                                            <input type="text" id="warehouse" name="warehouse" value="{{$purchase->warehouse}}"></br></br>
                                            <input type="text" id="totalQty" name="totalQty" value="{{$purchase->total_qty}}"></br></br>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary btn-update-supplier">Save changes</button>
                                        </div>

                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Modal -->

                </td>

                <td>
                    <form action="{{route('deletePurchase')}}" method="post">
                        @csrf
                        <input type="hidden" value="{{$purchase->id}}" name="purchase_id">
                        <button type="submit" class="btn btn-danger btn-delete-supplier">Delete</button>
                    </form>
                </td>
                <td>
                
                    {!! DNS2D::getBarcodePNGPath($purchase->barcode, 'PDF417'); !!}
                    
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