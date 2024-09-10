<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class StoreFactory extends Factory
{
    protected $model = Store::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'domain' => $this->faker->word(),
            'database_options' => json_encode([
                    'database' => $this->faker->word(),
                    'username' => $this->faker->word(),
                    'password' => '12345678',
            ]) ,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }}
