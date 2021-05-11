<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Tells Laravel it doesn't need it's security data related
    protected $guarded = [];
    
    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function cart_items()
    {
        return $this->belongsTo(CartItems::class);
    }
}
