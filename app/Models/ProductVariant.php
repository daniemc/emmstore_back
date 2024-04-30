<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'product_id',
        'color',
        'size',
        'brand',
        'characteristic1',
        'characteristic2',
        'barrcode',
        'active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Get the Product associated with the ProductVariant
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
