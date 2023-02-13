<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Braintree\Gateway;

class OrderController extends Controller
{
    public function generate(Request $request, Gateway $gateway)
    {
        // dd($gateway->clientToken()->generate());

        $token = $gateway->clientToken()->generate();
        $data = [
            'success' => true,
            'token' => $token
        ];
        return response()->json($data);
    }
    public function makePayment(OrderRequest $request, Gateway $gateway)
    {
        $amount = OrderController::totalPrice($request->products);
        //dd($amount);
        $result = $gateway->transaction()->sale([
            'amount' =>  $amount,
            'paymentMethodNonce' => $request->token,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
        if ($result->success) {
            $data = [
                'success' => true,
                'message' => 'Payment done correctly'
            ];
            return response()->json($data);
        } else {
            $data = [
                'success' => false,
                'message' => 'Payment refused'
            ];
            return response()->json($data);
        }
    }

    public static function totalPrice($productsIdsArray)
    {
        $totalPrice = 0;
        foreach ($productsIdsArray as $product_id) {
            $product = Product::find($product_id);
            $discount = $product->discount;
            $totalPrice += ($product->price - (($product->price / 100) * $discount));
        }
        return $totalPrice;
    }
}
