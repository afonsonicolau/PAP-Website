<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    // Tells Laravel it doesn't need it's security data related
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function billing()
    {
        return $this->belongsTo(Address::class);
    }

    public function delivery()
    {
        return $this->belongsTo(Address::class);
    }
    
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
