<x-admin-layout>

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Purchase Add</h4>
                    <h6>Add/Update Purchase</h6>
                </div>
            </div>
            <form enctype="multipart/form-data" method="POST" action="{{ route('addPurchase') }}" class="d-flex">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <select class="select" name="product" id="product">
                                        @if($products)
                                        @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}}-{{$product->sku}}</option>
                                        @endforeach
                                        @endif

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Supplier Name</label>
                                    <div class="row">
                                        <div class="col-lg-10 col-sm-10 col-10">
                                            <select class="select" name="supplier" id="supplier">
                                                @if($suppliers)
                                                @foreach($suppliers as $supplier)
                                                <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Purchase Date </label>
                                    <div class="input-groupicon">
                                        <input type="date" placeholder="DD-MM-YYYY"  id="purchaseDate" name="purchaseDate">
                                        <div class="addonset">
                                            <img src="assets/img/icons/calendars.svg" alt="img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Expiry Date </label>
                                    <div class="input-groupicon">
                                        <input type="date" placeholder="DD-MM-YYYY"  id="expiryDate" name="expiryDate">
                                        <div class="addonset">
                                            <img src="assets/img/icons/calendars.svg" alt="img">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Buying Price</label>
                                    <input type="text" id="buyingPrice" name="buyingPrice">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Selling Price</label>
                                    <input type="text" id="sellingPrice" name="sellingPrice">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Batch No</label>
                                    <input type="text" id="batchNo" name="batchNo">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Rack No</label>
                                    <input type="text" id="wrackNo" name="wrackNo">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Warehouse</label>
                                    <input type="text" id="warehouse" name="warehouse">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Total Quantity</label>
                                    <input type="text" id="totalQty" name="totalQty">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <button class="btn btn-submit me-2" type="submit">Submit</button>

                            </div>
                        </div>



                    </div>
                </div>
            </form>
        </div>
    </div>

    

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