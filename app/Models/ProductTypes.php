<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTypes extends Model
{
    use HasFactory;

    // Tells Laravel it doesn't need it's security data related
    protected $guarded = [];
    
    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
