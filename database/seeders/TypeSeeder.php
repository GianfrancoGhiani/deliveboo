<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks = 0;");
        Type::truncate();
        $types = ['italian pizza', 'pasta', 'burger', 'chinese rice', 'dolci', 'indian rice', 'japanese sushi', 'kebab'];

        foreach ($types as $type) {
            $newtype = new Type();
            $newtype->name = $type;
            $newtype->slug = Str::slug($newtype->name);
            $newtype->save();
        }
        DB::statement("SET foreign_key_checks = 1;");
    }
}