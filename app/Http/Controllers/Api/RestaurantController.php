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

        $restaurants = Restaurant::when(!empty($reqTypes), function ($query) use ($reqTypes) {
            $query->whereHas(
                'types',
                function ($q) use ($reqTypes) {
                    $q->whereIn('type_id', $reqTypes);
                }
            );
        })->with('types')
            ->get();

        return response()->json([
            'success' => true,
            'results' => [
                'restaurants' => $restaurants,
                'types' => $types,
                'reqTypes' => $reqTypes,
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * 
     */
    public function singleproduct($product_id, $product_Slug)
    {
        $product = Product::where('id', $product_id)->first();
        return response()->json([
            'success' => true,
            'results' => $product
        ]);
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
     */
    public function show($restaurantId, $restaurantslug)
    {

        $products = Product::where('restaurant_id', $restaurantId)->paginate(12);
        return response()->json([
            'success' => true,
            'results' => $products
        ]);
    }

    public function info($restaurantId)
    {
        $restaurant = Restaurant::where('id', $restaurantId)->first();
        return response()->json([
            'success' => true,
            'results' => $restaurant
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
