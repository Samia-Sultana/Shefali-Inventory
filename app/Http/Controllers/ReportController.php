<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Queue\Middleware\ThrottlesExceptionsWithRedis;
use Illuminate\Support\Facades\DB;

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
    public function inventory(){
        $purchases = Purchase::all();
        return view('inventory_report', compact('purchases'));
        
    }
    public function range(){
        $orders = array();
        return view('range_report', compact('orders'));
        
    }

    public function rangeOutput(Request $request){
        $start = $request->range_start;
        $end = $request->range_end;
        
        $orders = DB::table('orders')->whereBetween('date', [$start, $end])->get();
       
        return redirect()->back()->with(['orders' => json_encode($orders)]);
        
    }
}
