<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $category = DB::table('categories')->inRandomOrder()->first();
        $brand = DB::table('brands')->inRandomOrder()->first();
        $name = fake()->streetName();

        return [
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'name' => $name,
            'slug' => str($name . '-' . rand(100, 999))->slug(),
            'barcode' => fake()->unique()->isbn13(),
            'description' => fake()->text($maxNbChar = rand(100, 300)),
            'price' => fake()->randomFloat($nbMaxDecimals = 1, $min = 100,  $max = 1000),
            'stock'=>rand(0, 20),
            'viewed'=>rand(0, 100),
        ];
    }
}
