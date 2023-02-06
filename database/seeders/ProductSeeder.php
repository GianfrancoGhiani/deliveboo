<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::statement("SET foreign_key_checks = 0;");
        Product::truncate();
        $products = config('recipe.dishes');
        foreach ($products as $product) {
            $newproduct = new Product();
            $newproduct->name = $product['title'];
            $newproduct->slug = Str::slug($product['title']);
            $newproduct->price = $faker->randomFloat(2, 1, 30);
            $newproduct->available = true;
            $newproduct->discount = $faker->randomDigitNotNull() * 10;
            if (isset($product['ingredients'])) {
                $newproduct->ingredients = $product['ingredients'];
            } else {
                $newproduct->ingredients = null;
            }

            $newproduct->restaurant_id = $product['restaurant_id'];
            $newproduct->image_url = ProductSeeder::storeimage($product['image'], $product['title']);
            $newproduct->save();
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
        $name = $_name . '.jpg';
        $path = 'images/' . $name;
        Storage::put('images/' . $name, $contents);
        return $path;
    }
}