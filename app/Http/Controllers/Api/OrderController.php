<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function store(Request $request)
    {
        $data = $request->all();

        $new_order = new Order();
        $new_order->fill($data);
        $new_order->save();





        // $validator = Validator::make($data, [
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'message' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'success' => false,
        //         'errors' => $validator->errors()
        //     ]);
        // } else {
        //     $new_lead = new Order();
        //     $new_lead->fill($data);
        //     $new_lead->save();


        //     $contact = new NewContact($new_lead);
        //     // dd($contact);
        //     Mail::to('info@beanfolio')->send($contact);

        //     return response()->json([
        //         'success' => true

        //     ]);
        // }
    }
}