<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Address;

use Illuminate\Http\Request;

class AddressesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $addresses = Address::latest()->paginate('10');

        return view('backoffice.addresses.index', compact('addresses'));
    }
}
