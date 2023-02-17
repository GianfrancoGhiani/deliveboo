<?php

namespace Database\Seeders;

use App\Models\Order;
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
        for ($i = 0; $i < 2; $i++) {
            $neworder = new Order();
            $neworder->customer_firstname = $faker->name();
            $neworder->customer_lastname = $faker->lastName();
            $neworder->customer_email = $faker->email();
            $neworder->customer_address = $faker->address();
            $neworder->customer_tel = $faker->e164PhoneNumber();
            $neworder->price = $faker->randomFloat(2, 50, 500);
            $neworder->paid = $faker->numberBetween(0, 1);
            $neworder->description = $faker->text();
            $neworder->restaurant_id = 2;
            $neworder->created_at = Carbon::createFromFormat('Y-m-d H:i:s', '2023-02-14 15:30:00');
            ;
            $neworder->save();
            //$neworder->products()->attach([1, 4, 7, 10]);
            $neworder->products()->attach([30, 31, 32, 33]);
        }
        // DB::statement("SET foreign_key_checks = 1;");
    }
}