<x-admin-layout>

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>PURCHASE LIST</h4>
                    <h6>Manage your purchases</h6>
                </div>
                <div class="page-btn">
                    <a href="{{route('addPurchasePage')}}" class="btn btn-added">
                        <img src="{{asset('assets/img/icons/plus.svg')}}" alt="img">Add New Purchases
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-path">
                                <a class="btn btn-filter" id="filter_search">
                                    <img src="{{asset('assets/img/icons/filter.svg')}}" alt="img">
                                    <span><img src="{{asset('assets/img/icons/closes.svg')}}" alt="img"></span>
                                </a>
                            </div>
                            <div class="search-input">
                                <a class="btn btn-searchset"><img src="{{asset('assets/img/icons/search-white.svg')}}" alt="img"></a>
                            </div>
                        </div>

                    </div>



                    <div class="table-responsive">
                        <table class="table datanew">
                            <thead>
                                <tr>
                                    <th>
                                        <label class="checkboxs">
                                            <input type="checkbox" id="select-all">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    <th>Product Name</th>
                                    <th>Supplier Name</th>
                                    <th>Purchase Date</th>
                                    <th>Expiry Date</th>
                                    <th>Buying Price</th>
                                    <th>Selling Price</th>
                                    <th>Total qty</th>
                                    <th>Batch No</th>
                                    <th>Rack No</th>
                                    <th>Warehouse</th>

                                    <th>Barcode</th>
                                    <!-- <th>Payment Status</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($purchases)
                                @foreach($purchases as $purchase)
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>

                                    <td class="text-bolds">
                                        <?php

                                        $product = App\Models\Product::find($purchase->product_id);
                                        ?>
                                        {{$product->name}}
                                    </td>
                                    <td class="text-bolds">
                                        <?php
                                        $supplier = App\Models\Supplier::find($purchase->supplier_id);
                                        ?>
                                        {{$supplier->name}}
                                    </td>
                                    <td>{{$purchase->purchase_date}}</td>
                                    <td>{{$purchase->expiry_date}}</td>
                                    <td>{{$purchase->buying_price}}</td>
                                    <td>{{$purchase->selling_price}}</td>
                                    <td>{{$purchase->total_qty}}</td>
                                    <td>{{$purchase->batch_no}}</td>
                                    <td>{{$purchase->wrack_no}}</td>
                                    <td>{{$purchase->warehouse}}</td>

                                    <td>{{$purchase->barcode}}</td>

                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="{{'#update_purchase_'.$purchase->id}}">
                                            <img src="{{asset('assets/img/icons/edit.svg')}}" alt="img">
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

                                        <form action="{{route('deletePurchase')}}" method="post">
                                            @csrf
                                            <input type="hidden" value="{{$purchase->id}}" name="purchase_id">
                                            <button type="submit" class="btn btn-danger btn-delete-supplier">
                                                <img src="{{asset('assets/img/icons/delete.svg')}}" alt="img">
                                            </button>
                                        </form>


                                    </td>
                                </tr>
                                @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/js/feather.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js02"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>

    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>

    <script src="{{asset('assets/plugins/sweetalert/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sweetalert/sweetalerts.min.js')}}"></script>

    <script src="{{asset('assets/js/script.js')}}"></script>


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



</x-admin-layout>