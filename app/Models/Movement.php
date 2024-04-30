<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_variant_id',
        'user_id',
        'vendor_id',
        'customer_id',
        'store_id',
        'pos_id',
        'movement_type_id',
        'movement_code',
        'qty',
        'total_db',
        'total_cr',
        'status',
        'updated_by',
        'date',
    ];
}
