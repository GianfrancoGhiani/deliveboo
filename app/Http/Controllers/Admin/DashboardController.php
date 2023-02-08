<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            return view('admin.dashboard');
        } else {
            // dd('non hai il ristorante');
            return redirect()->route('admin.restaurants.create');
        }

    }
}