<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function index(Request $request)
    {
        $reqTypes = $request->query('types');
        $types = Type::all();

        $restaurants = Restaurant::with('types')
            ->when(!empty($reqTypes), function ($query, $reqTypes) {
                $query->whereHas('types', function ($q) use ($reqTypes) {
                    $q->where('id', $reqTypes);
                });
            })
            ->get();

        return response()->json([
            'success' => true,
            'results' => [
                'restaurants' => $restaurants,
                'types' => $types
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * 
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($restaurantId, $restaurantslug)
    {

        $products = Product::where('restaurant_id', $restaurantId)->paginate(12);
        return response()->json([
            'success' => true,
            'results' => $products
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
