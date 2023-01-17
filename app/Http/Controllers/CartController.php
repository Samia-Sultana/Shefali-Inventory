<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function addToCart(Request $request){
        $barcode = $request->input('barcode');
        $product = Purchase::where('barcode', "=", $barcode)->get();
        $cartProduct = (object) array(
            'barcode' =>$product[0]->barcode,
            'price' => $product[0]->selling_price,
            'qty' => 1
        );
        $oldCart  = $request->session()->has('cart')? $request->session()->get('cart'): null;
        if($oldCart){
            $inCart = false;
            foreach($oldCart as $item){
                if($item->barcode == $barcode){
                    $item->qty++;
                    $inCart = true;
                    break;
                }
            }
            if($inCart){
                $newCart = $oldCart;
            }
            else{
                $newCart = $oldCart;
                array_push($newCart,$cartProduct);
            }
        }
        else{
            $newCart = array($cartProduct);
        }
       
        $request->session()->put('cart', $newCart);
        $notification = array(
            'message' => 'product Added to list!',
            'alert-type' => 'success'
        );
        return redirect()->route('addOrderPage')->with($notification);
        
    }

    public function updateCart(Request $request){
        $barcode = $request->input('barcode');
        $product = Purchase::where('barcode', "=", $barcode)->get();
        $quantity = $request->input('newQuantity');
        $cart  = $request->session()->get('cart');
        foreach($cart as $item){
            if($item->barcode == $barcode){
                $item->qty = $quantity ;
                break;
            }
        }
        $request->session()->put('cart', $cart);
        return response()->json(['cart'=>json_encode($cart)]);
        
    
    }

    public function removeCartProduct(Request $request){
        
        $barcode = $request->input('barcode');
        $product = Purchase::where('barcode', "=", $barcode)->get();
        $cart = $request->session()->get('cart');
        foreach($cart as $key=>$item){
            
            if($cart[$key]->barcode == $barcode ){
                unset($cart[$key]);
                $newcart = array_values($cart);
                $request->session()->put('cart', $newcart);
            }
        }

        //view cart
        $subTotal = 0;
        $grandTotal = 0;
        if($request->session()->has('cart')){
            $cart = $request->session()->get('cart');
            foreach($cart as $item){
                $subTotal = $subTotal + ($item->price * $item->qty);
            }
            $grandTotal = $subTotal ;
            $notification = array(
                'message' => 'Remove product!',
                'alert-type' => 'success'
            );
            return redirect()->route('addOrderPage')->with($notification);
        }
        else{
            $notification = array(
                'message' => 'No product to Remove!',
                'alert-type' => 'success'
            );
            return redirect()->route('addOrderPage')->with($notification);
        }
            
        
    }

    public function checkout(Request $request){
       
        $customerId = $request->customer;
        $customer = Customer::find($customerId);

        //storing order in order invoice table
        $invoice = new Order();
        $invoice['phone'] = $customer['phone'];
        $invoice['user_id'] = $customerId;
        $invoice['address'] = $customer['address'];
        $invoice['city'] = $customer['city'];
        $invoice['status'] = "pending";
        $invoice->save();
        
        
        $cart = $request->session()->has('cart')? $request->session()->get('cart') : [];
        if(count($cart) > 0){
            foreach($cart as $item){
                $orderDetail = new Orderdetail();
                $orderDetail['order_id'] = $invoice['id'];
                
                $orderDetail['barcode_no'] = $item->barcode;
                $orderDetail['quantity'] = $item->qty;
                $orderDetail['singlePrice'] = $item->price;
               
                $orderDetail->save();
            }
        }
        
        $request->session()->forget('cart');
        $notification = array(
            'message' => 'Order successfull!!',
            'alert-type' => 'success'
        );

        return redirect()->route('addOrderPage')->with($notification);
        
    }
    
    
   
}