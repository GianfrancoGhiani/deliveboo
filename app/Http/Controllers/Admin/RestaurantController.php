<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Restaurant;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        return view('admin.restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRestaurantRequest  $request
     * 
     */
    public function store(Request $request)
    {

        dd($request);
        // $newRestaurant = new Restaurant();
        // $newRestaurant->name = $request->name;
        // $newproduct->slug = Str::slug($request->name);
        // $newproduct->ingredients = $request->ingredients;
        // $newproduct->price = $request->price;
        // $newproduct->available = $request->available;
        // $newproduct->discount = $request->discount;
        // $newproduct->restaurant_id = Auth::id();
        return view('admin.restaurants.index');
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