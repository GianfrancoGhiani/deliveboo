<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChartsController extends Controller
{
    //
    public function index(Request $request)
    {
        // dd($request->restaurantId);
        // return [
        //     "result" => $request->filter
        // ];
        $filter = $request->filter;
        $orders = Order::where('restaurant_id', $request->restaurantId)->when(
            $filter,
            function ($query, $filter) {
                $query->where('created_at', 'LIKE', $filter . '%');
            }
        )
            ->selectRaw('count(*) as total, DATE(created_at) as date')->groupBy(DB::raw("DATE(created_at)"))->get();

        $data = [
            'success' => true,
            'results' => $orders
        ];
        return response()->json($data);
    }
}
