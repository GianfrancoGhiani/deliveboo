<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;


class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //DB::statement("SET foreign_key_checks = 0;");
        //Order::truncate();
        // for ($i = 0; $i < 3; $i++) {
        //     $neworder = new Order();
        //     $neworder->customer_firstname = $faker->name();
        //     $neworder->customer_lastname = $faker->lastName();
        //     $neworder->customer_email = $faker->email();
        //     $neworder->customer_address = $faker->address();
        //     $neworder->customer_tel = $faker->e164PhoneNumber();
        //     $neworder->price = $faker->randomFloat(2, 50, 500);
        //     $neworder->paid = $faker->numberBetween(0, 1);
        //     $neworder->description = $faker->text();
        //     $neworder->restaurant_id = 1;
        //     $neworder->save();
        //     $neworder->products()->attach([1, 4, 7, 10]);
        //     // $neworder->products()->attach([30, 31, 32, 33]);
        // }
        for ($i = 0; $i < 30; $i++) {
            $neworder = new Order();
            $neworder->customer_firstname = $faker->name();
            $neworder->customer_lastname = $faker->lastName();
            $neworder->customer_email = $faker->email();
            $neworder->customer_address = $faker->address();
            $neworder->customer_tel = $faker->e164PhoneNumber();


            $price = OrderSeeder::totalPrice([['id' => 30, 'q' => 3], ['id' => 31, 'q' => 1], ['id' => 32, 'q' => 3], ['id' => 33, 'q' => 1]])['amount'];



            $neworder->price = $price;
            $neworder->paid = $faker->numberBetween(0, 1);
            $neworder->description = $faker->text();
            $neworder->restaurant_id = 2;
            $neworder->created_at = Carbon::createFromFormat('Y-m-d H:i:s', '2023-02-18 15:30:00');;
            $neworder->save();
            //$neworder->products()->attach([1, 4, 7, 10]);
            $neworder->products()->attach([31, 32]);
        }
        // DB::statement("SET foreign_key_checks = 1;");
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
}
