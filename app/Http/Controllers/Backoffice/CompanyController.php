<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\CompanyDetails;
use App\Models\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $data = CompanyDetails::first();

        return view('backoffice.company.index', compact('data'));
    }

    public function update(Request $request)
    {
        $data = CompanyDetails::first();

        // IVA
        if($request->has('iva'))
        {
            $iva = $request->iva;
            if(is_numeric($iva) && $iva > 0 && $iva <= 50) {
                $data->update([
                    'iva' => $iva,
                ]);

                foreach(Product::all() as $product) {
                    $product->update([
                        'iva' => $iva,
                    ]);
                }
            }
            else {
                return redirect()->back()->with('error', 'Insira um IVA válido.');
            }
        }
        // ATM
        elseif($request->has('atm'))
        {
            $atm = $request->atm;
            if(is_numeric($atm) && $atm >= 10000 && $atm <= 99999) {
                $data->update([
                    'atm_reference' => $atm,
                ]);
            }
            else {
                return redirect()->back()->with('error', 'Insira uma referência Multibanco válida.');
            }
        }
        // Paypal
        elseif($request->has('paypal'))
        {
            $paypal = $request->paypal;
            if(is_numeric($paypal) && $paypal >= 10000 && $paypal <= 99999) {
                $data->update([
                    'paypal_reference' => $paypal,
                ]);
            }
            else {
                return redirect()->back()->with('error', 'Insira uma referência Paypal válida.');
            }
        }
        // Debit Card
        elseif($request->has('debitcard'))
        {
            $debitcard = $request->debitcard;
            if(is_numeric($debitcard) && $debitcard >= 10000 && $debitcard <= 99999) {
                $data->update([
                    'debitcard_reference' => $debitcard,
                ]);
            }
            else {
                return redirect()->back()->with('error', 'Insira uma referência de Cartão de Débito válida.');
            }
        }

        return redirect(route('company.index'));
    }
}
