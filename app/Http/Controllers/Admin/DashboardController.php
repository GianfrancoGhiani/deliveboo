<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Perform login validation and authentication

        // Check if the user has previously logged in
        // if (!session()->has('logged_in')) {
        //     // Set the success message to be displayed
        //     session()->flash('success', 'Welcome back! You have successfully logged in.');
        //     // Set the logged_in session variable to true
        //     session()->put('logged_in', true);
        // }

        if (Auth::user()->restaurant) {
            // dd('hai il ristorante');

            $restaurant = Restaurant::where('user_id', Auth::id())->first();
            // dd($restaurant);
            $orders = Order::where('restaurant_id', Auth::user()->restaurant->id)->selectRaw('count(*) as total, DATE(created_at) as date')->groupBy(DB::raw("DATE(created_at)"))->get();
            // dd($orders);
            return view('admin.dashboard', compact('restaurant', 'orders'));
        } else {
            // dd('non hai il ristorante');
            return redirect()->route('admin.restaurants.create');
        }
    }
}