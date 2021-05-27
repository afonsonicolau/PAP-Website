<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDetails extends Model
{
    // Tells Laravel it doesn't need it's security data related
    protected $guarded = [];

    protected $primaryKey = 'atm_reference';

    use HasFactory;
}
