<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allProduct = Purchase::all();
        $orders = Order::all();
        return view('createOrder', compact('orders', 'allProduct'));
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
        $input = $request->all();
        $order = new Order();
        $order['name'] = $request->name;
        $order['phone'] = $request->phone;
        $order['address'] = $request->address;
        $order['shipping'] = $request->shipping;
        $order['city'] = $request->city;
        $order['message'] = $request->message;
        $order['status'] = 'pending';
        $order['total_amount'] = $request->total_amount;
        $order->save();

        $cart = $request->session()->get('cart');
        foreach($cart as $item){
            $orderDetail = new Orderdetail();
            $orderDetail['orderinvoice_id'] = $order['id'];
            $orderDetail['barcode'] = $item->barcode;
            $orderDetail['quantity'] = $item->qty;
            $orderDetail->save();
        }
        
        $request->session()->forget('cart');
        $notification = array(
            'message' => 'Order Added!',
            'alert-type' => 'success'
        );
        return redirect()->route('viewOrderPage')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $orders = Order::all();
        return view('orderList', compact('orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Order $order)
    {
        $id = $request->input('order_id');
        DB::table('orders')->where('id',$id)->delete();

        $notification = array(
            'message' => 'order deleted successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('orderList')->with($notification);
    }

    public function statusUpdate(Request $request){
        $all = $request->all();
        $id = $all['order_id'];
        $status = $all['status'];

        if($status == "complete"){
            $purchasedProducts = DB::table('orderdetails')->where('order_id', $id)->get();
            foreach($purchasedProducts as $product){
                $barcode = $product->barcode;
                $stock = DB::table('purchases')->where('barcode', $barcode)->get();
                $totalStock = $stock[0]->totalQty - $product->quantity ;
                DB::table('purchases')->where('barcode', $barcode)->update([
                    'total_qty' => $totalStock
                ]);
            }
        }
        else{

        }
        DB::table('orders')
        ->where('id', $id)
        ->update([
            'status' => $status
        ]);

        return response()->json(['success'=>'Status Changed Successfully']);

    }
}
