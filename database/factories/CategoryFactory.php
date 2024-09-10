<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        $store_ids = Store::pluck('id')->toArray();

        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'store_id' => $store_ids[array_rand($store_ids)],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
