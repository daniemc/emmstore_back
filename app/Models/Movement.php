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
        'type',
        'qty',
        'total_db',
        'total_cr',
        'status',
        'updated_by',
    ];
}
