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
        $token = $gateway->clientToken()->generate();
        $data = [
            'success' => true,
            'token' => $token
        ];
        return response()->json($data);
    }
    public function makePayment(OrderRequest $request, Gateway $gateway)
    {

        $amount = OrderController::totalPrice($request->products)['amount'];

        $result = $gateway->transaction()->sale([
            'amount' =>  intval($amount),
            'paymentMethodNonce' => $request->token,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
        $restaurantId = OrderController::totalPrice($request->products)['restaurantId'];
        $description = '';
        if ($result->success) {
            $request->products;

            $description = "Payment done correctly! Thank you " . $request->customerData['customer_firstname'] . "
            You have ordered: 
            ";
            foreach ($request->products as $productData) {
                $product = Product::where('id', $productData['id'])->first();
                $description .= $product->name . ", quantity: " . $productData['q'] .  "
                ";
            };
        } else {
            $description = 'Payment refused!';
        }


        OrderController::storeOrder($request, $amount, $result->success, $restaurantId, $description);
        if ($result->success) {
            $data = [
                'success' => true,
                'message' => 'Payment done correctly!'
            ];
            return response()->json($data);
        } else {
            $data = [
                'success' => false,
                'message' => 'Payment refused!'
            ];
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

    public static function storeOrder($request, $totalPrice, $paid, $r_id, $descr)
    {
        $customerData = $request->customerData;
        $products = $request->products;
        $neworder = new Order();
        $neworder->customer_firstname = $customerData['customer_firstname'];
        $neworder->customer_lastname = $customerData['customer_lastname'];
        $neworder->customer_email = $customerData['customer_email'];
        $neworder->customer_address = $customerData['customer_address'];
        $neworder->customer_tel = $customerData['customer_tel'];
        $neworder->price = $totalPrice;
        $neworder->paid = $paid;
        $neworder->description = $descr;
        $neworder->restaurant_id = $r_id;
        $neworder->save();


        foreach ($products as $product) {
            $neworder->products()->attach([$product['id'] => ['quantity' => $product['q']]]);
        }
    }
}
