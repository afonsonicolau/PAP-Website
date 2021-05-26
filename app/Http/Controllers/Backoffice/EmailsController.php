<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\UserEmailCompany;

use Illuminate\Http\Request;

class EmailsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $emailsSent = UserEmailCompany::latest()->paginate('10');

        return view('backoffice.emails.index', compact('emailsSent'));
    }
}
