<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function sale(){
        $sales = Purchase::all();
        return view('sale_report', compact('sales'));

    }
    public function purchase(){
        $purchases = Purchase::all();
        return view('purchase_report', compact('purchases'));
        
    }
    public function invoice(){
        $orders = Order::all();
        return view('invoice_report', compact('orders'));
        
    }
}
