<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    
    */
    public function index()
    {
        $restaurantId = Auth::id();
        $products = Product::where('restaurant_id', $restaurantId)->get();
        return view('admin.products.index', compact('products'));
    }

    /**
    * Show the form for creating a new resource.
    *
    
    */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \App\Http\Requests\StoreProductRequest  $request
    
    */
    public function store(StoreProductRequest $request)
    {
        $newproduct = new Product();
        $newproduct->name = $request->name;
        $newproduct->slug = Str::slug($request->name);
        $newproduct->ingredients = $request->ingredients;
        $newproduct->price = $request->price;
        $newproduct->available = $request->available;
        $newproduct->discount = $request->discount;
        $newproduct->restaurant_id = Auth::id();
        if ($request->hasFile('image_url')) {
            $path = Storage::disk('public')->put('images/', $request->image_url);
            $newproduct['image_url'] = $path;
        }

        if (count(Product::where('restaurant_id', Auth::id())->where('name', $newproduct->name)->get())) {
            return back()->with('message', 'name is taken!');
        }

        $newproduct->save();

        return redirect()->action([ProductController::class, 'index'])->with('message', "$newproduct->name created");
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Product  $product
    
    */
    public function show(Product $product)
    {

        $restaurantId = Auth::id();
        if (count(Product::where('restaurant_id', Auth::id())->where('name', $product->name)->get())) {
            return back()->with('message', 'name is taken!');
        } else {

            $tempProd = Product::where('slug', $product->slug)->where('restaurant_id', $restaurantId)->first();

            if ($tempProd) {
                $product = $tempProd;
                return view('admin.products.show', compact('product'));
            } else {
                return abort(404);
            }
        }
        // dd($tempProd);

    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Product  $product
    
    */
    public function edit(Product $product)
    {
        $restaurantId = Auth::id();
        $tempProd = Product::where('slug', $product->slug)->where('restaurant_id', $restaurantId)->first();
        // dd($tempProd);
        if ($tempProd) {
            $product = $tempProd;
            return view('admin.products.edit', compact('product'));
        } else {
            return abort(404);
        }
        ;
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \App\Models\Product  $product
    
    */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $restaurantId = Auth::id();
        $tempProd = Product::where('slug', $product->slug)->where('restaurant_id', $restaurantId)->first();
        // dd($tempProd);
        if ($tempProd) {
            $product = $tempProd;
            $product->name = $request->name;
            $product->slug = Str::slug($request->name);
            $product->ingredients = $request->ingredients;
            $product->price = $request->price;
            $product->available = $request->available;
            $product->discount = $request->discount;
            $product->restaurant_id = Auth::id();
            if ($request->hasFile('image_url')) {
                $path = Storage::disk('public')->put('images/', $request->image_url);
                $product['image_url'] = $path;
            }
            $product->update();
            return redirect()->action([ProductController::class, 'index'])->with('message', "$product->name updated");
        } else {
            return abort(404);
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Product  $product
    
    */
    public function destroy(Product $product)
    {

        $restaurantId = Auth::id();
        $tempProd = Product::where('slug', $product->slug)->where('restaurant_id', $restaurantId)->first();
        // dd($tempProd);
        if ($tempProd) {
            $tempProd->delete();
            return redirect()->action([ProductController::class, 'index'])->with('message', "$tempProd->name deleted");
        } else {
            return abort(404);
        }
    }
}