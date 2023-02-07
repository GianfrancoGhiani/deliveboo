<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\restaurant;
use App\Http\Requests\StorerestaurantRequest;
use App\Http\Requests\UpdaterestaurantRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * @param  \App\Http\Requests\StorerestaurantRequest  $request
     * 
     */
    public function store(Request $request)
    {
        //
        dd($request);
        $newRestaurant = new Restaurant();
        $newRestaurant->name = $request->name;
        // $newproduct->slug = Str::slug($request->name);
        // $newproduct->ingredients = $request->ingredients;
        // $newproduct->price = $request->price;
        // $newproduct->available = $request->available;
        // $newproduct->discount = $request->discount;
        // $newproduct->restaurant_id = Auth::id();
        return view('admin.restaurant.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\restaurant  $restaurant
     * 
     */
    public function show(restaurant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdaterestaurantRequest  $request
     * @param  \App\Models\restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdaterestaurantRequest $request, restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(restaurant $restaurant)
    {
        //
    }
}