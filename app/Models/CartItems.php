<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItems extends Model
{
    use HasFactory;

    // Tells Laravel it doesn't need it's security data related
    protected $guarded = [];
    protected $primaryKey = 'cart_id';
    
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
