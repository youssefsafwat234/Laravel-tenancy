<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $store_ids = Store::pluck('id')->toArray();
        $category_ids = Category::pluck('id')->toArray();

        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'category_id' =>$category_ids[array_rand($category_ids)],
            'store_id' =>  $store_ids[array_rand($store_ids)],
            'price' => rand(1, 20000),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
