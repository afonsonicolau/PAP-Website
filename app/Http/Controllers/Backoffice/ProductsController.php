<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;

use App\Models\Collection;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductTypes;
use App\Models\CartItems;
use Carbon\Carbon;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use Image;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }
    
    public function index()
    {
        $products = Product::where('disabled', 0)->latest()->paginate(20);
        $standoutCount = Product::where('standout', 1)->count();
        
        return view('backoffice.products.index', compact('products', 'standoutCount'));
    }

    public function create()
    {
        $collections = Collection::all();
        $types = ProductTypes::all();

        return view('backoffice.products.create', compact('collections', 'types'));
    }

    public function getInfo($collectionId, $typeId)
    {
        if($collectionId != "null")
        {
            $collection = Collection::find($collectionId);

            $colors = $collection->colors;

            return $colors;
        }
        else if($typeId != "null")
        {
            $type = ProductTypes::find($typeId);

            $reference = json_decode($type->reference);

            return $reference;
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipo' => 'required',
            'colecao' => 'required',
            'cor' => 'required',
            'tamanho' => 'required|regex:/^([0-9]){3}x([0-9]){3}/|size:7',
            'preco' => 'required',
            'peso' => 'required',
            'stock' => 'required',
            'descrição' => 'required',
            'miniatura' => 'required|image|mimes:jpeg,jpg,png',
            'imagens' => '',
            'imagens.*' => '|mimes:jpeg,jpg,png',
        ]);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        else
        {
            // Variable treatment
            $color = $request->cor; 
            $color = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"), $color);

            $collection = Collection::find($request->colecao);
            $collectionImageName = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"), $collection->collection);

            $productType = ProductTypes::find($request->tipo);
            
            $timeNow = Carbon::now()->format('Y-m-d_H-i-m');

            // For thumbnail
            if($thumbnail = $request->file('miniatura'))
            {
                // Get the original file name and after that get his extension
                $thumbnailName = $thumbnail->getClientOriginalName();
                $extension = pathinfo($thumbnailName, PATHINFO_EXTENSION); // Image extension | .jpg, .png, .jpeg, etc...
                
                // Create custom name
                $thumbnailName = "thumbnail_" . $productType->reference . "_" . $productType->type . "_" . $collectionImageName . "_" . $timeNow . "." . $extension;
                
                // Image path to database
                $imagePath = $request->file('miniatura')->storeAs('thumbnail', $thumbnailName, 'public');
                
                // Image Intervention "fitting" the image and saving it in storage
                $image = Image::make(public_path('/storage/' . $imagePath))->fit(1500, 1500);
                $image->save();
            }

            // For images
            if($request->hasFile('imagens'))
            {
                $i = 1;

                foreach($request->file('imagens') as $image)
                {
                    // Get the orginial image name
                    $imageName = $image->getClientOriginalName();
                    // Get image extension
                    $extension = pathinfo($imageName, PATHINFO_EXTENSION);

                    // Create custom name
                    $imageName = "produto_" . $i . "_" . $productType->reference . "_" . $productType->type . "_" . $collectionImageName . "_" . $timeNow . "." . $extension;

                    // Image path to database
                    $imagePath = $image->storeAs('products', $imageName, 'public');
                    
                    // Image Intervention "fitting" the image and saving it in storage
                    $imageSave = Image::make(public_path('/storage/' . $imagePath))->fit(1500, 1500);
                    $imageSave->save();

                    $imageArray[] = $imageName;

                    $i++;
                }
            }
            else
            {
                $imageArray = [];
            }

                $imageNames = json_encode($imageArray);

                // Create and save to database
                Product::create([
                    'type_id' => $request->tipo,
                    'collection_id' => $request->colecao,
                    'color' => $request->cor,
                    'size' => $request->tamanho,
                    'price' => $request->preco,
                    'iva' => $request->iva,
                    'weight' => $request->peso,
                    'stock' => $request->stock,
                    'description' => $request->descrição,
                    'thumbnail' => $thumbnailName,
                    'images' => $imageNames,
                ]);
            
            return redirect(route('products.index'));
        }
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $collections = Collection::all();
        $types = ProductTypes::all(); 
        $imageNames = json_decode($product->images);

        return view('backoffice.products.edit', compact('collections', 'product', 'types', 'imageNames'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $cartItems = CartItems::where('product_id', $id);

        // Standout
        if($request->has('standout'))
        {
            $standoutCount = Product::where('standout', 1)->count();

            if($standoutCount < 9)
            {
                $product->update([
                    'standout' => $request->standout,
                ]);
            }

            return redirect(route('products.index'));
        }
        // Outlet
        else if($request->has('outlet'))
        {
            $product->update([
                'outlet' => $request->outlet,
            ]);

            return redirect(route('products.index'));
        }
        // Visible
        else if ($request->has('visible'))
        {
            $product->update([
                'visible' => $request->visible,
                'standout' => 0,
            ]);

            $cartItems->delete();

            return redirect(route('products.index'));
        }
        // Disable
        else if($request->has('disable'))
        {
            $product->update([
                'disabled' => 1,
            ]);
        }
        // Normal update
        else
        {
            $validator = Validator::make($request->all(), [
                'tipo' => 'required',
                'colecao' => 'required',
                'cor' => 'required',
                'tamanho' => 'required|regex:/^([0-9]){3}x([0-9]){3}/|size:7',
                'preco' => 'required',
                'iva' => 'required',
                'peso' => 'required',
                'stock' => 'required',
                'descrição' => 'required',
                'miniatura' => 'image|mimes:jpeg,jpg,png',
                'imagens' => '',
                'imagens.*' => '|mimes:jpeg,jpg,png',
            ]);
            
            if($validator->fails())
            {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            else
            {
                // Variable treatment
                $color = $request->cor; 
                $color = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"), $color);

                $collection = Collection::find($request->colecao);
                $collectionImageName = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"), $collection->collection);

                $productType = ProductTypes::find($request->tipo);

                $timeNow = Carbon::now()->format('Y-m-d_H-i-m');

                // Thumbnail
                if($thumbnail = $request->file('miniatura'))
                {
                    Storage::delete('public/thumbnail' . $product->thumbnail);

                    // Get the original file name and after that get his extension
                    $thumbnailName = $thumbnail->getClientOriginalName();
                    $extension = pathinfo($thumbnailName, PATHINFO_EXTENSION); // Image extension | .jpg, .png, .jpeg, etc...
                    
                    // Create custom name
                    $thumbnailName = "thumbnail_" . $productType->reference . "_" . $productType->type . "_" . $collectionImageName . "_" . $timeNow . "." . $extension;
                    
                    // Image path to database
                    $imagePath = $request->file('miniatura')->storeAs('thumbnail', $thumbnailName, 'public');
                    
                    // Image Intervention "fitting" the image and saving it in storage
                    $image = Image::make(public_path('/storage/' . $imagePath))->fit(1500, 1500);
                    $image->save();
                }
                
                $savedImages = json_decode($product->images);

                // For images
                if($request->hasFile('imagens'))
                {
                    $i = count($savedImages) + 1;

                    foreach($request->file('imagens') as $image)
                    {
                        // Get the orginial image name
                        $imageName = $image->getClientOriginalName();
                        // Get image extension
                        $extension = pathinfo($imageName, PATHINFO_EXTENSION);

                        // Create custom name
                        $imageName = "produto_" . $i . "_" . $productType->reference . "_" . $productType->type . "_" . $collectionImageName . "_" . $timeNow . "." . $extension;

                        // Image path to database
                        $imagePath = $image->storeAs('products', $imageName, 'public');
                        
                        // Image Intervention "fitting" the image and saving it in storage
                        $imageSave = Image::make(public_path('/storage/' . $imagePath))->fit(1500, 1500);
                        $imageSave->save();

                        array_push($savedImages, $imageName);

                        $i++;
                    }
                }

                $imageNames = json_encode($savedImages);

                $product->update([
                    'type_id' => $request->tipo,
                    'collection_id' => $request->colecao,
                    'color' => $request->cor,
                    'size' => $request->tamanho,
                    'price' => $request->preco,
                    'iva' => $request->iva,
                    'weight' => $request->peso,
                    'stock' => $request->stock,
                    'description' => $request->descrição,
                    'thumbnail' => $thumbnailName ?? $product->thumbnail,
                    'images' => $imageNames,
                ]);

                foreach($cartItems as $item)
                {
                    $cart = Cart::find($item->cart_id);

                    if($cart != null && $cart->bought == 0)
                    {
                        $cartItems->where('cart_id', $cart->id);

                        $cartItems->update([
                            'price' => $request->preco,
                            'iva' => $request->iva,
                        ]);
                    }
                }
                
                return redirect(route('products.index'));
            }
        } 
    }
}