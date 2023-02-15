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
        // dd($gateway);

        $token = $gateway->clientToken()->generate();
        $data = [
            'success' => true,
            'token' => $token
        ];
        return response()->json($data);
    }
    public function makePayment(OrderRequest $request, Gateway $gateway)
    {
        // dd($request);
        $amount = OrderController::totalPrice($request->products)['amount'];

        $result = $gateway->transaction()->sale([
            'amount' =>  intval($amount),
            'paymentMethodNonce' => $request->token,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
        $restaurantId = OrderController::totalPrice($request->products)['restaurantId'];
        // dd($request);
        if ($result->success) {
            $data = [
                'success' => true,
                'message' => 'Payment done correctly!'
            ];
            // $description =
            //     " 
            // {$data['message']} 
            // Thank you {$request->customerData['customer_firstname']} { $request->customerData['customer_lastname']}.
            // You have ordered:



            // -------
            // Products list
            // -------


            // ";

            return response()->json($data);
        } else {
            $data = [
                'success' => false,
                'message' => 'Payment refused!'
            ];
            // $description = $data['message'];

            return response()->json($data);
        }
    }

    public static function totalPrice($productsIdsQuantityArray)
    {
        $totalPrice = 0;
        foreach ($productsIdsQuantityArray as $tempProduct) {
            $prodQuantity = $tempProduct['q'];
            $product = Product::find($tempProduct['id']);

            $restaurantId = $product->restaurant_id;
            $discount = $product->discount;
            if ($discount) {
                $totalPrice += (($product->price - (($product->price / 100) * $discount))) * $prodQuantity;
            } else {
                $totalPrice += $product->price * $prodQuantity;
            }
        }
        return [
            'amount' => $totalPrice,
            'restaurantId' => $restaurantId
        ];
    }

    public static function storeOrder($formData, $totalPrice, $paid, $r_id, $descr)
    {
        $neworder = new Order();
        $neworder->customer_firstname = $formData['customer_firstname'];
        $neworder->customer_lastname = $formData['customer_lastname'];
        $neworder->customer_email = $formData['customer_email'];
        $neworder->customer_address = $formData['customer_address'];
        $neworder->customer_tel = $formData['customer_tel'];
        $neworder->price = $formData['$totalPrice'];
        $neworder->paid = $formData['$paid'];
        $neworder->description = $descr;
        $neworder->restaurant_id = $r_id;
        $neworder->save();
    }
}
