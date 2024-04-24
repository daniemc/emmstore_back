<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'description',
        'active',
        'warehouse',
    ];

    protected $casts = [
        'active' => 'boolean',
        'warehouse' => 'boolean',
    ];

    /**
     * Get all of the users for the Store
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(UserStore::class, 'store_id', 'id');
    }
}
