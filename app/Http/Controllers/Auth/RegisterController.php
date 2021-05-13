<?php

namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Cart;
use App\Notifications\CustomVerifyEmailNotification;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'termos' => 'required',
        ],
        [
            'username.*' => 'Insira um nome de utilizador válido',
            'email.unique' => 'Este endereço de e-mail já se encontra em uso',
            'email.*' => 'Insira um e-mail válido',
            'password.confirmed' => 'Palavra-passe não correspondente.',
            'password.*' => 'Insira uma palavra-passe válida',
            'termos.*' => 'Para continuar assinale o "Concordo com os Termos e Condições"',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user = User::latest()->first();

        $user->notify(new CustomVerifyEmailNotification());
        
        Cart::create([
            'user_id' => $user->id,
        ]);

        return $user;
    }
}
