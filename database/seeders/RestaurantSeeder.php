<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
// use Faker\Provider\en_US\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        DB::statement("SET foreign_key_checks = 0;");
        Restaurant::truncate();
        // dd($faker->ein());
        $restaurants = config('recipe.restaurants');
        for ($i = 0; $i < count($restaurants); $i++) {
            $newrestaurant = new Restaurant();
            $newrestaurant->name = $restaurants[$i]['name'];
            $newrestaurant->slug = Str::slug($newrestaurant->name);
            $newrestaurant->address = $restaurants[$i]['address'];
            $newrestaurant->tel_num = $restaurants[$i]['phone'];
            $newrestaurant->image_url = RestaurantSeeder::storeimage($restaurants[$i]['image_url'], $newrestaurant->name);
            $newrestaurant->opening_time = $faker->time();
            $newrestaurant->closing_time = $faker->time();
            $newrestaurant->piva = $faker->ein();
            $newrestaurant->user_id = $i + 1;
            $newrestaurant->save();
        }
        DB::statement("SET foreign_key_checks = 1;");
    }

    public static function storeimage($url, $_name)
    {
        $contents = file_get_contents($url, false, stream_context_create([
            "ssl" => [
                "verify_peer" => false,
                "verify_peer_name" => false,
            ],
        ]));
        $name = str_replace(" ", "", $_name) . '.jpg';
        $path = 'images/' . $name;
        Storage::put('images/' . $name, $contents);
        return $path;
    }
}
