<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
// use Faker\Provider\en_US\Company;
use Illuminate\Support\Str;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // dd($faker->ein());
        for ($i = 0; $i < 8; $i++) {

            $newrestaurant = new Restaurant();
            $newrestaurant->name = $faker->company();
            $newrestaurant->slug = Str::slug($newrestaurant->name);
            $newrestaurant->address = $faker->streetName() . ', ' . $faker->buildingNumber() . ', ' . 'New York';
            $newrestaurant->tel_num = $faker->phoneNumber();
            $newrestaurant->opening_time = $faker->time();
            $newrestaurant->closing_time = $faker->time();
            $newrestaurant->piva = $faker->ein();
            //$newrestaurant->type_id = $i + 1;
            $newrestaurant->user_id = $i + 1;
            $newrestaurant->save();
        }
    }
}
