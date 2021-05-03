<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Product;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function destroy($id, $imageName)
    {        
        $product = Product::find($id);
        $images = json_decode($product->images);

        $exists = false;

        foreach ($images as $key => $value) {
            if (strcmp($value, $imageName) == 0) {
                array_splice($images, $key, 1);
                
                $product->images = json_encode($images);

                Storage::delete('public/products/' . $imageName);

                $exists = true;

                break;
            }
        }

        if(!$exists)
        {
            $imageArray = [];
            $product->images = json_encode($imageArray);
        }

        $product->save();

        return $exists;
    }
}
