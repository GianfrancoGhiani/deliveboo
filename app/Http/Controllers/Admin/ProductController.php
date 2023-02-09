<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Type;
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
        //filtriamo i prodotti con una query build di laravel per visualizzare solo i prodotti di quel determinato ristorante
        if (Auth::user()->restaurant->id) {

            $restaurantId = Auth::user()->restaurant->id;
            $products = Product::where('restaurant_id', $restaurantId)->get();
            return view('admin.products.index', compact('products'));
        } else {
            $types = Type::all();
            return redirect()->route('admin.restaurants.create', compact('types'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        if (Auth::user()->restaurant->id) {
            return view('admin.products.create');
        } else {
            $types = Type::all();
            return redirect()->route('admin.restaurants.create', compact('types'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     */
    public function store(StoreProductRequest $request)
    {
        if (Auth::user()->restaurant->id) {
            //inizializziamo la creazione del prodotto
            $newproduct = new Product();

            //passiamo i dati convalidati dalla request creata "StoreProductRequest"
            $newproduct->name = $request->name;
            $newproduct->slug = Str::slug($request->name);
            $newproduct->ingredients = $request->ingredients;
            $newproduct->price = $request->price;
            $newproduct->available = $request->available;
            $newproduct->discount = $request->discount;
            $newproduct->restaurant_id = Auth::user()->restaurant->id;

            //se la request ha presente un file immagine lo andiamo a salvare al nuovo prodotto
            if ($request->hasFile('image_url')) {
                $path = Storage::disk('public')->put('images/', $request->image_url);
                $newproduct['image_url'] = $path;
            }

            //controlliamo se il nome del nuovo prodotto è già presente nel suo ristorante, se è vero lo rimandiamo indietro con un messaggio di errore 
            if (count(Product::where('restaurant_id', Auth::user()->restaurant->id)->where('name', $newproduct->name)->get())) {
                return back()->with('message', 'This name is taken!');
            }

            $newproduct->save();

            return redirect()->action([ProductController::class, 'index'])->with('message', "$newproduct->name created");
        } else {
            $types = Type::all();
            return redirect()->route('admin.restaurants.create', compact('types'));
        }
    }

    /**
     * Display the specified resource.
     *
     *
     */
    public function show(Product $product)
    {
        //qui prendiamo direttamente l'id ristorante associato all'utente
        if (Auth::user()->restaurant->id) {

            $restaurantId = Auth::user()->restaurant->id;

            $tempProd = Product::where('slug', $product->slug)->where('restaurant_id', $restaurantId)->first();

            //scommenta il dd della riga sotto per verificare che l'id del prodotto appartiene effettivamente al ristorante dell'utente loggato 
            // dd($tempProd);

            //se il prodotto esiste mandiamo l'utente alla rotta show con il prodotto selezionato
            if ($tempProd) {

                $product = $tempProd;

                return view('admin.products.show', compact('product'));
            } else {

                //se non esiste il prodotto ritorniamo un messaggio di errore
                return back()->with('error', 'This product do not exist!');
            }
        } else {
            $types = Type::all();
            return redirect()->route('admin.restaurants.create', compact('types'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * 
     */
    public function edit(Product $product)
    {

        // dd(Auth::user()->restaurant->id);

        if (Auth::user()->restaurant->id) {

            $restaurantId = Auth::user()->restaurant->id;
            //selezioniamo con una query il giusto prodotto associato a un determinato ristorante
            $tempProd = Product::where('slug', $product->slug)->where('restaurant_id', $restaurantId)->first();
            //possiamo controllare con un dd()
            // dd($tempProd);


            if ($tempProd) {

                $product = $tempProd;

                return view('admin.products.edit', compact('product'));
            } else {
                //se non esiste il prodotto ritorniamo un messaggio di errore
                return back()->with('error', 'This product do not exist!');
            }
        } else {
            $types = Type::all();
            return redirect()->route('admin.restaurants.create', compact('types'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Product  $product
    
     */
    public function update(UpdateProductRequest $request, Product $product)
    {

        if (Auth::user()->restaurant->id) {

            $restaurantId = Auth::user()->restaurant->id;

            //controllo che il nome del prodotto modificato non sia già presente nel db del ristorante
            if (count(Product::where('restaurant_id', $restaurantId)->where('name', $request->name)->get())) {
                return back()->with('message', 'name is taken!');
            }

            //creo una query per selezionare il giusto prodotto associato al ristorante 
            $tempProd = Product::where('slug', $product->slug)->where('restaurant_id', $restaurantId)->first();

            //sommenta sotto per controllare che l'id del prodotto sia quello associato al ristorante  
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

                //funzione per salvere l'immagine nel caso sia stata caricata
                if ($request->hasFile('image_url')) {
                    $path = Storage::disk('public')->put('images/', $request->image_url);
                    $product['image_url'] = $path;
                }


                $product->update();

                //riporto l'utente all'index dei prodotto con un messaggio di successo 
                return redirect()->action([ProductController::class, 'index'])->with('message', "$product->name updated");
            } else {
                //se non esiste il prodotto ritorniamo un messaggio di errore
                return back()->with('error', 'This product do not exist!');
            }
        } else {
            $types = Type::all();
            return redirect()->route('admin.restaurants.create', compact('types'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * 
     */
    public function destroy(Product $product)
    {

        if (Auth::user()->restaurant->id) {

            $restaurantId = Auth::user()->restaurant->id;

            //query per selezionare il giusto prodotto
            $tempProd = Product::where('slug', $product->slug)->where('restaurant_id', $restaurantId)->first();

            // dd($tempProd);
            if ($tempProd) {

                //cancella con una softdelete
                $tempProd->delete();

                return redirect()->action([ProductController::class, 'index'])->with('message', "$tempProd->name deleted");
            } else {
                //se non esiste il prodotto ritorniamo un messaggio di errore
                return back()->with('error', 'This product do not exist!');
            }
        } else {
            $types = Type::all();
            return redirect()->route('admin.restaurants.create', compact('types'));
        }
    }
}
