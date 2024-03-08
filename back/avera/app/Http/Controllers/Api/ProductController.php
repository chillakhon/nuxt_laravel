<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController extends Controller
{


    public function index(Request $request)
    {
        $user_id = $request->user()->id;

        $products = Product::with('images')
            ->where('user_id', $user_id)
            ->get();

        return response()->json($products);
    }
    public function products_all(Request $request)
    {
        $products = Product::with('images')->get();

        return response()->json($products);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'numeric',
            'images.*' => 'image'
        ]);

        $validatedData['user_id'] = Auth::user()->id;

        $product = Product::create($validatedData);

        if ($request->hasFile('images')) {
            $manager = new ImageManager(new Driver());
            foreach ($request->file('images') as $image) {
                $random = rand(1000000, 99999999) . '_' . $product->id;
                $imageName = $random . '.' . $image->getClientOriginalExtension();
                $img = $manager->read($image);
                $img = $img->resize(370,246);
                $img->save(public_path('storage/products/'. $imageName));

                $product->images()->create([
                    'image_path' => $imageName,
                    'is_main' => false,
                ]);
            }

        }
        $products = Product::with('images')->get();
        return response()->json($products);
    }


    public function show($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return response()->json($product);
    }


    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validatedData);

        return response()->json($product);
    }


    public function destroy(Product $product)
    {
        $storage_images = ProductImage::where('product_id', $product->id)->pluck('image_path');

        foreach ($storage_images as $image) {
            $path = public_path('storage/products/'. $image);

            if(File::exists($path)) {
                File::delete($path);
            }
        }

        $product->delete();

        return response()->json(null, 204);
    }


}
