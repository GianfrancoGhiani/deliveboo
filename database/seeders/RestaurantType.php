<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('restaurant_type')->truncate();


        $restaurants_types = [
            [
                "id" => 1,
                "types" => [1, 9]
            ],
            [
                "id" => 2,
                "types" => [2, 9]
            ],
            [
                "id" => 3,
                "types" => [3, 9]
            ],
            [
                "id" => 4,
                "types" => [4, 9]
            ],
            [
                "id" => 5,
                "types" => [5, 9]
            ],
            [
                "id" => 6,
                "types" => [6, 9]
            ],
            [
                "id" => 7,
                "types" => [7, 9]
            ],
            [
                "id" => 8,
                "types" => [1, 2, 3, 4, 8, 9]
            ],
            [
                "id" => 9,
                "types" => [9]
            ],
        ];





        foreach ($restaurants_types as $restaurant) {
            foreach ($restaurant['types'] as $type)

                DB::table('restaurant_type')->insert([
                    'restaurant_id' => $restaurant['id'],
                    'type_id' => $type,

                ]);

        }
    }
}