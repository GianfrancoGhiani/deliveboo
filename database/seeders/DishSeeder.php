<?php

namespace Database\Seeders;

use App\Models\Dish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $dishes = config('recipe');
        foreach ($dishes as $dish) {
            $newdish = new Dish();
            $newdish->name = $dish['title'];
            $newdish->slug = Str::slug($dish['title']);
            $newdish->price = $faker->randomFloat(2, 1, 30);
            $newdish->available = true;
            $newdish->discount = $faker->randomDigitNotNull() * 10;
            $newdish->ingredients = $dish['ingredients'];
            $newdish->restaurant_id = $dish['restaurant_id'];
            $newdish->image_url = $dish['image_url'];
            $newdish->save();
        }
    }
}
