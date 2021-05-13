<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use App\Models\Collection;
use App\Models\Product;

class CollectionsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $collections = Collection::latest()->paginate(10);
        $products = Product::all();

        $colors = "";
        $colorsText = "";
        $i = 0;
        // ->latest()
        return view('backoffice.collections.index', compact('collections', 'products', 'i', 'colors', 'colorsText'));
    }

    public function create()
    {
        return view('backoffice.collections.create');
    }

    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'coleção' => 'required|alpha|unique:collections,collection',
            'cores' => 'required',
        ]);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        else
        {
            $colors = $request->cores;
            $colorsArray = explode(",", $colors); 

            $colorsValidation = array();
            foreach($colorsArray as $color)
            {
                if(!preg_match('~[0-9]+~', $color))
                {
                    if(strpos($color, ' ') == true)
                    {
                        $colorCleared = str_replace(' ', '', $color);

                        array_push($colorsValidation, $colorCleared);
                    }
                    else
                    {
                        array_push($colorsValidation, $color);
                    }
                } 
                else
                {
                    return Redirect::back()->withInput()->withErrors($validator);

                    break;
                }
            }
            $colorsArray = json_encode($colorsValidation);

            // Create and save to database
            Collection::create([
                'collection' => $request->coleção,
                'colors' => $colorsArray,
            ]);
            
            return redirect(route('collections.index'));
        }
    }

    public function edit($id)
    {
        $collection = Collection::find($id);

        $colors = json_decode($collection->colors);
        $colorsText = "";
      
        foreach ($colors as $value) {
            $colorsText .= $value . ',';
        }

        $colorsText = rtrim($colorsText, ", ");
        
        return view('backoffice.collections.edit', compact('collection', 'colorsText'));
    }

    public function update(Request $request, $id)
    {
        $collection = Collection::find($id);

        $validator = Validator::make($request->all(), [
            'coleção' => 'required|alpha|unique:collections,collection,' . $collection->id,
            'cores' => 'required',
        ]);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        else
        {
            if(request->has('disable'))
            {
                Collection::find($id)->update([
                    'disabled' => 1,
                ]);

                $products = Product::where('collection_id', $id)->get();
                // Deletes images before deleting products
                foreach($products as $product)
                {
                    $product->update([
                        'disabled' => 1,
                    ]);
                    
                    /* if($product->images != null)
                    {
                        $images = "";
                        $images = json_decode($product->images);

                        foreach($images as $key => $value)
                        {
                            Storage::delete('public/products/' . $value);
                        }

                        Storage::delete('public/thumbnail/' . $product->thumbnail);
                        Product::where('id', $product->id)->delete();

                        $collection->delete();
                    } */
                }

                return true;
            }
            else
            {
                $colors = $request->cores;
                $colorsArray = explode(",", $colors); 

                $colorsValidation = array();
                foreach($colorsArray as $color)
                {
                    if(!is_numeric($color))
                    {
                        if(strpos($color, ' ') == true)
                        {
                            $colorCleared = str_replace(' ', '', $color);

                            array_push($colorsValidation, $colorCleared);
                        }
                        else
                        {
                            array_push($colorsValidation, $color);
                        }
                    }
                }

                $colorsArray = json_encode($colorsValidation);

                // Create and save to database
                $collection->update([
                    'collection' => $request->coleção,
                    'colors' => $colorsArray,
                ]);

                return redirect(route('collections.index'));
            }
        }
    }

    public function destroy($id)
    {
        
    }

}
