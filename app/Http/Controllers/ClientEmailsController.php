<?php

namespace App\Http\Controllers;

use App\Mail\UserEmail;
use App\Models\UserEmailCompany;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ClientEmailsController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:100',
            'email' => 'required|email|max:100',
            'assunto' => 'required|max:100',
            'mensagem' => 'required|max:255',
        ]);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        else
        {   
            UserEmailCompany::create([
               'name' => $request->nome, 
               'email' => $request->email,
               'subject' => $request->assunto,
               'message' => $request->mensagem,
            ]);
            
            Mail::to('geral@olfaire.com')->send(new UserEmail($request->nome, $request->assunto, $request->mensagem, $request->email));

            return redirect()->back()->with('success', 'O seu e-mail foi enviado, muito obrigado pelo seu tempo!');   
        }
    }
}
