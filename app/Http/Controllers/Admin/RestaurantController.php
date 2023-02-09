<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreRestaurantRequest;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Type;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * 
     */
    public function create()
    {

        //accorciato codice
        if (Auth::user()->restaurant) {
            return redirect()->route('admin.dashboard');
        }
        $types = Type::all();
        return view('admin.restaurants.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * 
     * 
     */
    public function store(StoreRestaurantRequest $request)
    {


        $newRestaurant = new Restaurant();
        $newRestaurant->name = $request->name;
        $newRestaurant->slug = Str::slug($request->name);
        $newRestaurant->address = $request->address;
        $newRestaurant->piva = $request->piva;
        $newRestaurant->opening_time = $request->opening_time;
        $newRestaurant->closing_time = $request->closing_time;
        $newRestaurant->user_id = Auth::id();
        $newRestaurant->tel_num = $request->tel_num;

        if ($request->hasFile('image_url')) {
            $path = Storage::disk('public')->put('images/', $request->image_url);
            $newRestaurant['image_url'] = $path;
        }
        $newRestaurant->save();

        if ($request->has('types')) {
            $newRestaurant->types()->attach($request->types);
        }
        return redirect()->route('admin.dashboard');
    }


    /**
     * Display the specified resource.
     *
     *
     * 
     */
    public function show(Restaurant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * 
     *
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * 
     * 
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }
}