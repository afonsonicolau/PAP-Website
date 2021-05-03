<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductTypes;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class TypesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $types = ProductTypes::latest()->paginate(20);
        $products = Product::all();

        return view('backoffice.types.index', compact('types', 'products'));
    }

    public function create()
    {
        return view('backoffice.types.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipo' => 'required|alpha|unique:product_types,type',
        ]);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        else
        {
            // Create and save to database
            ProductTypes::create([
                'type' => $request->tipo,
            ]);

            return redirect(route('types.index'));
        }
    }

    public function edit($id)
    {
        $types = ProductTypes::find($id);

        return view('backoffice.types.edit', compact('types'));
    }

    public function update(Request $request, $id)
    {
        $type = ProductTypes::find($id);

        $validator = Validator::make($request->all(), [
            'tipo' => 'required|alpha|unique:product_types,type,' . $type->id,
        ]);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        else
        {
            $type->update([
                'type' => $request->tipo,
            ]);

            return redirect(route('types.index'));
        }
    }

    public function destroy($id)
    {
        $type = ProductTypes::find($id);
        $products = Product::where('type_id', '=', $id)->get();

            // Deletes images before deleting products
            foreach($products as $product)
            {
                if($product->images != null)
                {
                    $images = "";
                    $images = json_decode($product->images);
    
                    foreach($images as $key => $value)
                    {
                        Storage::delete('public/products/' . $value);
                    }
    
                    Storage::delete('public/thumbnail/' . $product->thumbnail);
                    Product::where('id', $product->id)->delete();

                    $type->delete();
                }
            }
        
        return true;
    }
}
