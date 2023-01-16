<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\Pure;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        $purchases = Purchase::all();
        return view('createPurchase',compact('products','suppliers','purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Purchase::create([
        'product_id' => $request->product,
        'supplier_id'=> $request->supplier,
        'buying_price' => $request->buyingPrice,
        'selling_price' =>$request->sellingPrice,
        'purchase_date' =>$request->purchaseDate,
        'expiry_date' =>$request->expiryDate,
        'batch_no' =>$request->batchNo,
        'wrack_no' =>$request->wrackNo,
        'warehouse' =>$request->warehouse,
        'total_qty'=>$request->totalQty,
        'available_qty' =>$request->totalQty,
        'barcode' => $request->product . $request->supplier . $request->batchNo . $request->purchaseDate . $request->expiryDate,

        ]);

        $notification = array(
            'message' => 'Purchase information added!',
            'alert-type' => 'success'
        );
        return redirect()->route('viewPurchasePage')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
       
        $purchase = Purchase::find($request->purchaseId);
        $purchase->update([
            'product_id' => $request->product,
            'supplier_id'=> $request->supplier,
            'buying_price' => $request->buyingPrice,
            'selling_price' =>$request->sellingPrice,
            'purchase_date' =>$request->purchaseDate,
            'expiry_date' =>$request->expiryDate,
            'batch_no' =>$request->batchNo,
            'wrack_no' =>$request->wrackNo,
            'warehouse' =>$request->warehouse,
            'total_qty'=>$request->totalQty,
            'available_qty' =>$request->totalQty,
            'barcode' => $request->product . '_' . $request->supplier . '_' . $request->batchNo . '_' . $request->purchaseDate . '_' . $request->expiryDate,
            ]);

            $notification = array(
                'message' => 'Purchase information updated!',
                'alert-type' => 'success'
            );
            return redirect()->route('viewPurchasePage')->with($notification);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Purchase $purchase)
    {
        $id = $request->purchase_id;
        Purchase::find($id)->delete();
        $notification = array(
            'message' => 'Purchase Deleted!',
            'alert-type' => 'success'
        );
        return redirect()->route('viewPurchasePage')->with($notification);
    }

    public function generateBarcode(Request $request){
        $purchase = Purchase::find($request->purchase_id);
        dd($purchase);
        return view('barcodeGenerator');
    }
}
