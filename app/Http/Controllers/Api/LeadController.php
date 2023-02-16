<?php

namespace App\Http\Controllers\Api;

use App\Models\Lead;
use Illuminate\Http\Request;
use App\Mail\NewMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class LeadController extends Controller
{

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        } else {
            $new_lead = new Lead();
            $new_lead->fill($data);
            $new_lead->save();


            $contact = new NewMessage($new_lead);
            // dd($contact);
            Mail::to('deliveboo.2023@gmail.com')->send($contact);

            return response()->json([
                'success' => true
            ]);
        }
    }
}
