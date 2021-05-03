<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Tells Laravel it doesn't need it's security data related
    protected $guarded = [];

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    public function type()
    {
        return $this->belongsTo(ProductTypes::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
}
