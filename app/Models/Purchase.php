<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'supplier_id',
        'buying_price',
        'selling_price',
        'purchase_date',
        'expiry_date',
        'batch_no',
        'wrack_no',
        'warehouse',
        'total_qty',
        'available_qty',
        'barcode'
    ];
}
