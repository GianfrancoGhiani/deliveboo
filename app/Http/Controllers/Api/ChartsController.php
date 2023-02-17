<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
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

    public function weekorders(Request $request)
    {



        $weeksAgo = $request->input('week_ago');
        $startDate = Carbon::now()->startOfWeek()->subWeeks($weeksAgo); // data di inizio settimana (lunedì)
        $endDate = $startDate->copy()->addDays(7); // data di fine settimana (domenica)
        $orders = Order::where('restaurant_id', $request->restaurantId)->selectRaw('count(*) as total, DATE(created_at) as date')->whereBetween('created_at', [$startDate, $endDate])->groupBy(DB::raw("DATE(created_at)"))->get();



        $week = [
            'Monday' => 0,
            'Tuesday' => 0,
            'Wednesday' => 0,
            'Thursday' => 0,
            'Friday' => 0,
            'Saturday' => 0,
            'Sunday' => 0,
        ];
        foreach ($orders as $order) {
            $day = Carbon::parse($order['date'])->format('l');
            $week[$day] = $order['total'];
        }

        $data = [
            'success' => true,
            'results' => $week
        ];
        return response()->json($data);
    }
}