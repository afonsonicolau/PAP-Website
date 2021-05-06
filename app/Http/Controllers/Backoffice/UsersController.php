<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    // View for showing clients
    public function client()
    {
        $users = User::where('disabled', 0)->where('role_id', 1)->latest()->paginate(20); 

        return view('backoffice.users.client', compact('users'));
    }

    // View for showing administators
    public function administrator()
    {
        $users = User::where('disabled', 0)->where('role_id', 2)->latest()->paginate(20); 

        return view('backoffice.users.administrator', compact('users'));
    }

    public function update($id, Request $request)
    {
       $user = User::find($id);
        
        if($request->has('role_id'))
        {
            $user->role_id = $request->role_id;
        }   
        elseif($request->has('disable'))
        {
            $user->disabled = 1;
        }
        
        $user->save();
        
        return redirect()->back();
    }
}
