<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Perform login validation and authentication

        // Check if the user has previously logged in
        if (!session()->has('logged_in')) {
            // Set the success message to be displayed
            session()->flash('success', 'Welcome back! You have successfully logged in.');
            // Set the logged_in session variable to true
            session()->put('logged_in', true);
        }

        return view('admin.dashboard');
    }
}
