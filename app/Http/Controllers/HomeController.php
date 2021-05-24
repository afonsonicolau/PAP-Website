<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin', 'verified']);
    }

    public function index()
    {
        return view('backoffice.index');
    }
}
